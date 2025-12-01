<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class KategoriController
{
    public function home(){
        $data = Cache::remember('kategori_list', now()->addMinutes(10), function () {
            return Kategori::all()->sortByDesc('created_at');
        });
        $active = 'kategori';

        return view('admin.management.kategori.kategori', compact('data','active'));
    }

    public function tambah(){
        $active = 'kategori';

        return view('admin.management.kategori.tambah', compact('active'));
    }

    public function store(Request $request){
        $data = new Kategori();

        $data->nama_kategori = $request->nama_kategori;

        if ($request->hasFile('IconKategori')) {
            $file = $request->file('IconKategori');
            // Buat nama unik
            $nama_icon = time() . '_' . $file->getClientOriginalName();
            // Simpan ke folder public/data/produk/
            $file->move(public_path('img/icon/'), $nama_icon);
            // Simpan nama file ke database
            $data->icon_kategori = $nama_icon;
        }

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            // Buat nama unik
            $nama_thumbnail = time() . '_' . $file->getClientOriginalName();
            // Simpan ke folder public/data/produk/
            $file->move(public_path('img/data/kategori'), $nama_thumbnail);
            // Simpan nama file ke database
            $data->thumbnail = $nama_thumbnail;
        }
        $data->save();

        Cache::forget('kategori_list');

        return redirect()->route('adminKategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id){
        $kategori = Kategori::find($id);
        $active = 'kategori';

        return view('admin.management.kategori.edit', compact('kategori', 'active'));
    }

    public function update(Request $request, $id)
    {
        $data = Kategori::find($id);

        $data->nama_kategori = $request->nama_kategori;

        if ($request->hasFile('IconKategori')) {
            // Path ke file lama
            $pathLama = public_path('img/icon/' . $data->icon_kategori);

            // Hapus file lama jika ada dan file-nya masih ada di server
            if (file_exists($pathLama)) {
                unlink($pathLama);
            }

            // Proses upload thumbnail baru
            $file = $request->file('IconKategori');
            $nama_icon = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/icon/'), $nama_icon);

            // Simpan nama file baru ke database
            $data->icon_kategori = $nama_icon;
        }

        if ($request->hasFile('thumbnail')) {
            // Path ke file lama
            $pathLama = public_path('img/data/kategori/' . $data->thumbnail);

            // Hapus file lama jika ada dan file-nya masih ada di server
            if (file_exists($pathLama)) {
                unlink($pathLama);
            }

            // Proses upload thumbnail baru
            $file = $request->file('thumbnail');
            $nama_thumbnail = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/data/kategori'), $nama_thumbnail);

            // Simpan nama file baru ke database
            $data->thumbnail = $nama_thumbnail;
        }
        $data->save();

        Cache::forget('kategori_list');

        return redirect()->route('adminKategori')->with('success', 'Kategori berhasil diubah');
    }

    public function delete($id){
        $data = Kategori::find($id);
        if(!$data){
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        if($data->thumbnail){
            $path = public_path('img/data/kategori/' . $data->thumbnail);
            if(File::exists($path)){
                File::delete($path);
            }
        }

        if($data->icon_kategori){
            $path = public_path('img/icon/' . $data->icon_kategori);
            if(File::exists($path)){
                File::delete($path);
            }
        }

        $data->delete();

        Cache::forget('kategori_list');

        return response()->json(['message' => 'Kategori berhasil dihapus']);
    }
}
