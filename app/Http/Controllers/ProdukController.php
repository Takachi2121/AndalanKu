<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class ProdukController
{
    public function home(){
        $data = Cache::remember('produk_list', now()->addMinutes(10), function () {
            return Produk::all()->sortByDesc('created_at');
        });
        $active = 'produk';

        return view('admin.management.produk.produk', compact('data','active'));
    }

    public function tambah(){
        $active = 'produk';
        $kategori = Cache::remember('kategori_list', now()->addMinutes(10), function(){
            return Kategori::all();
        });

        return view('admin.management.produk.tambah', compact('active', 'kategori'));
    }

    public function store(Request $request){
        $data = new Produk;

        $data->nama_produk = $request->nama_produk;
        $data->deskripsi = $request->deskripsi;
        $data->kategori_id = $request->kategori;
        $data->harga = $request->harga;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // Buat nama unik
            $nama_gambar = time() . '_' . $file->getClientOriginalName();
            // Simpan ke folder public/data/produk/
            $file->move(public_path('img/data/produk'), $nama_gambar);
            // Simpan nama file ke database
            $data->gambar = $nama_gambar;
        }
        $data->save();

        Cache::forget('produk_list');

        return redirect()->route('adminProduct')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id){
        $data = Produk::find($id);
        $active = 'produk';
        $produk = Produk::where('id', $id)->first();
        $kategori = Cache::remember('kategori_list', now()->addMinutes(10), function(){
            return Kategori::all();
        });

        return view('admin.management.produk.edit', compact('data', 'active', 'kategori', 'produk'));
    }

    public function update(Request $request, $id)
    {
        $data = Produk::find($id);

        $data->nama_produk = $request->nama_produk;
        $data->deskripsi = $request->deskripsi;
        $data->kategori_id = $request->kategori;
        $data->harga = $request->harga;

        // Cek apakah ada gambar baru diupload
        if ($request->hasFile('gambar')) {
            // Path ke file lama
            $pathLama = public_path('img/data/produk/' . $data->gambar);

            // Hapus file lama jika ada dan file-nya masih ada di server
            if (file_exists($pathLama)) {
                unlink($pathLama);
            }

            // Proses upload gambar baru
            $file = $request->file('gambar');
            $nama_gambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/data/produk'), $nama_gambar);

            // Simpan nama file baru ke database
            $data->gambar = $nama_gambar;
        }

        $data->update();

        Cache::forget('produk_list');

        return redirect()->route('adminProduct')->with('success', 'Produk berhasil diubah');
    }

    public function delete($id){
        $data = Produk::find($id);
        if(!$data){
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        if($data->gambar){
            $path = public_path('img/data/produk/' . $data->gambar);
            if(File::exists($path)){
                File::delete($path);
            }
        }

        $data->delete();

        Cache::forget('produk_list');

        return response()->json(['message' => 'Produk berhasil dihapus']);
    }
}
