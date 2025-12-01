<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GaleriController
{
    public function home(){
        $data = Cache::remember('galeri_list', now()->addMinutes(10), function () {
            return Galeri::all()->sortByDesc('created_at');
        });
        $active = 'galeri';

        return view('admin.management.galeri.galeri', compact('data','active'));
    }

    public function tambah(){
        $active = 'galeri';

        return view('admin.management.galeri.tambah', compact('active'));
    }

    public function store(Request $request){
        $data = new Galeri();

        $data->title = $request->nama_galeri;
        $data->caption = $request->deskripsi_galeri;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            // Buat nama unik
            $nama_thumbnail = time() . '_' . $file->getClientOriginalName();
            // Simpan ke folder public/data/produk/
            $folder = Str::slug($request->nama_galeri);
            $file->move(public_path('img/data/Galeri/' . $folder), $nama_thumbnail);
            // Simpan nama file ke database
            $data->thumbnail = "{$folder}/{$nama_thumbnail}";
        }

        if ($request->hasFile('dokumentasi')) {
            $file = $request->file('dokumentasi');
            // Buat nama unik
            $nama_dokumentasi = time() . '_' . $file->getClientOriginalName();
            // Simpan ke folder public/data/produk/
            $folder = Str::slug($request->nama_galeri);
            $file->move(public_path('img/data/Galeri/' . $folder), $nama_dokumentasi);
            // Simpan nama file ke database
            $data->dokumentasi = "{$folder}/{$nama_dokumentasi}";
        }

        if ($request->hasFile('rancangan')) {
            $file = $request->file('rancangan');
            // Buat nama unik
            $nama_rancangan = time() . '_' . $file->getClientOriginalName();
            // Simpan ke folder public/data/produk/
            $folder = Str::slug($request->nama_galeri);
            $file->move(public_path('img/data/Galeri/' . $folder), $nama_rancangan);
            // Simpan nama file ke database
            $data->rancangan = "{$folder}/{$nama_rancangan}";
        }

        $data->save();

        Cache::forget('galeri_list');

        return redirect()->route('adminGaleri')->with('success', 'Galeri berhasil ditambahkan');
    }

    public function edit($id){
        $Galeri = Galeri::find($id);
        $active = 'Galeri';

        return view('admin.management.galeri.edit', compact('Galeri', 'active'));
    }

    public function update(Request $request, $id)
    {
        $data = Galeri::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data galeri tidak ditemukan');
        }

        // Simpan nama folder lama (sebelum perubahan)
        $oldFolder = Str::slug($data->title);
        $newFolder = Str::slug($request->nama_galeri);

        // Update basic info
        $data->title = $request->nama_galeri;
        $data->caption = $request->deskripsi_galeri;

        $newFolderPath = public_path('img/data/Galeri/' . $newFolder);

        // Buat folder baru jika belum ada
        if (!File::exists($newFolderPath)) {
            File::makeDirectory($newFolderPath, 0755, true);
        }

        // ================== THUMBNAIL ==================
        if ($request->hasFile('thumbnail')) {
            if ($data->thumbnail && File::exists(public_path('img/data/Galeri/' . $data->thumbnail))) {
                File::delete(public_path('img/data/Galeri/' . $data->thumbnail));
            }

            $file = $request->file('thumbnail');
            $nama_thumbnail = time() . '_' . $file->getClientOriginalName();
            $file->move($newFolderPath, $nama_thumbnail);
            $data->thumbnail = "{$newFolder}/{$nama_thumbnail}";
        } else {
            // Pindahkan file lama ke folder baru jika nama_galeri berubah
            if ($oldFolder !== $newFolder && $data->thumbnail) {
                $oldPath = public_path('img/data/Galeri/' . $data->thumbnail);
                $newPath = $newFolderPath . '/' . basename($data->thumbnail);

                if (File::exists($oldPath)) {
                    File::move($oldPath, $newPath);
                    $data->thumbnail = "{$newFolder}/" . basename($data->thumbnail);
                }
            }
        }

        // ================== DOKUMENTASI ==================
        if ($request->hasFile('dokumentasi')) {
            if ($data->dokumentasi && File::exists(public_path('img/data/Galeri/' . $data->dokumentasi))) {
                File::delete(public_path('img/data/Galeri/' . $data->dokumentasi));
            }

            $file = $request->file('dokumentasi');
            $nama_dokumentasi = time() . '_' . $file->getClientOriginalName();
            $file->move($newFolderPath, $nama_dokumentasi);
            $data->dokumentasi = "{$newFolder}/{$nama_dokumentasi}";
        } else {
            if ($oldFolder !== $newFolder && $data->dokumentasi) {
                $oldPath = public_path('img/data/Galeri/' . $data->dokumentasi);
                $newPath = $newFolderPath . '/' . basename($data->dokumentasi);

                if (File::exists($oldPath)) {
                    File::move($oldPath, $newPath);
                    $data->dokumentasi = "{$newFolder}/" . basename($data->dokumentasi);
                }
            }
        }

        // ================== RANCANGAN ==================
        if ($request->hasFile('rancangan')) {
            if ($data->rancangan && File::exists(public_path('img/data/Galeri/' . $data->rancangan))) {
                File::delete(public_path('img/data/Galeri/' . $data->rancangan));
            }

            $file = $request->file('rancangan');
            $nama_rancangan = time() . '_' . $file->getClientOriginalName();
            $file->move($newFolderPath, $nama_rancangan);
            $data->rancangan = "{$newFolder}/{$nama_rancangan}";
        } else {
            if ($oldFolder !== $newFolder && $data->rancangan) {
                $oldPath = public_path('img/data/Galeri/' . $data->rancangan);
                $newPath = $newFolderPath . '/' . basename($data->rancangan);

                if (File::exists($oldPath)) {
                    File::move($oldPath, $newPath);
                    $data->rancangan = "{$newFolder}/" . basename($data->rancangan);
                }
            }
        }

        // Simpan perubahan
        $data->save();

        // Hapus folder lama jika nama galeri berubah dan folder lama sudah tidak dipakai
        if ($oldFolder !== $newFolder) {
            $oldFolderPath = public_path('img/data/Galeri/' . $oldFolder);
            if (File::exists($oldFolderPath)) {
                File::deleteDirectory($oldFolderPath);
            }
        }

        Cache::forget('galeri_list');

        return redirect()->route('adminGaleri')->with('success', 'Galeri berhasil diubah');
    }

    public function delete($id){
        $data = Galeri::find($id);
        if(!$data){
            return response()->json(['message' => 'Galeri tidak ditemukan'], 404);
        }

        if($data->thumbnail){
            $folder = Str::slug($data->title);
            $path = public_path('img/data/Galeri/' . $folder);
            if(File::exists($path)){
                File::deleteDirectory($path);
            }
        }

        $data->delete();

        Cache::forget('galeri_list');

        return response()->json(['message' => 'Galeri berhasil dihapus']);
    }
}
