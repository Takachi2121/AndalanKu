<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TestimoniController
{
    public function home(){
        $active = "testimoni";
        $data = Cache::remember('testimoni_list', now()->addMinutes(10), function () {
            return Testimoni::all()->sortByDesc('created_at');
        });
        return view('admin.management.testimoni.testimoni', compact('active', 'data'));
    }

    public function tambah(){
        $active = "testimoni";
        return view('admin.management.testimoni.tambah', compact('active'));
    }

    public function store(Request $request){
        $testimoni = new Testimoni();

        $testimoni->nama_client = $request->nama_testimoni;
        $testimoni->nama_perusahaan = $request->nama_perusahaan;
        $testimoni->testimoni = $request->testimoni;

        if ($request->hasFile('img_testimoni')) {
            $file = $request->file('img_testimoni');
            // Buat nama unik
            $nama_testimoni = time() . '_' . $file->getClientOriginalName();
            // Simpan ke folder public/data/produk/
            $file->move(public_path('img/data/testimoni/'), $nama_testimoni);
            // Simpan nama file ke database
            $testimoni->profile = $nama_testimoni;
        }

        Cache::forget('testimoni_list');

        $testimoni->save();

        return redirect()->route('adminTestimoni')->with('success', 'Testimoni berhasil ditambahkan');
    }

    public function edit($id){
        $testimoni = Testimoni::find($id);
        $active = 'testimoni';

        return view('admin.management.testimoni.edit', compact('testimoni', 'active'));
    }

    public function update(Request $request, $id){
        $testimoni = Testimoni::find($id);

        $testimoni->nama_client = $request->nama_testimoni;
        $testimoni->nama_perusahaan = $request->nama_perusahaan;
        $testimoni->testimoni = $request->testimoni;

        if ($request->hasFile('img_testimoni')) {
            // Path ke file lama
            $pathLama = public_path('img/data/testimoni/' . $testimoni->profile);

            // Hapus file lama jika ada dan file-nya masih ada di server
            if (file_exists($pathLama)) {
                unlink($pathLama);
            }

            // Proses upload thumbnail baru
            $file = $request->file('img_testimoni');
            $nama_testimoni = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/data/testimoni/'), $nama_testimoni);

            // Simpan nama file baru ke database
            $testimoni->profile = $nama_testimoni;
        }

        $testimoni->update();

        Cache::forget('testimoni_list');

        return redirect()->route('adminTestimoni')->with('success', 'Testimoni berhasil diubah');
    }

    public function delete($id)
    {
        $data = Testimoni::find($id);

        if (!$data) {
            return response()->json(['message' => 'Testimoni tidak ditemukan'], 404);
        }

        // Hapus foto jika ada
        if ($data->profile) {
            $path = public_path('img/data/testimoni/' . $data->profile);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        // 🔥 Hapus data dari database
        $data->delete();

        // Kosongkan cache (jika kamu memang pakai ini di tampilan)
        Cache::forget('testimoni_list');

        // ✅ Kembalikan response JSON karena ini dipanggil via AJAX
        return response()->json(['message' => 'Testimoni berhasil dihapus']);
    }

}
