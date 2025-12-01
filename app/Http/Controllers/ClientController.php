<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ClientController
{
    public function home(){
        $active = "client";
        $data = Client::all()->sortByDesc('created_at');

        return view('admin.management.client.client', compact('active', 'data'));
    }

    public function tambah(){
        $active = "client";

        return view('admin.management.client.tambah', compact('active'));
    }

    public function store(Request $request){
        $data = new Client();

        $data->nama_client = $request->nama_client;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            // Buat nama unik
            $nama_logo = time() . '_' . $file->getClientOriginalName();
            // Simpan ke folder public/data/produk/
            $file->move(public_path('img/data/client'), $nama_logo);
            // Simpan nama file ke database
            $data->logo_client = $nama_logo;
        }
        $data->save();

        return redirect()->route('adminClient')->with('success', 'Client berhasil ditambahkan');
    }

    public function edit($id){
        $active = "client";
        $data = Client::find($id);

        return view('admin.management.client.edit', compact('active', 'data'));
    }

    public function update(Request $request, $id){
        $data = Client::find($id);

        $data->nama_client = $request->nama_client;

        if ($request->hasFile('logo')) {
            // Path ke file lama
            $pathLama = public_path('img/data/client/' . $data->logo_client);

            // Hapus file lama jika ada dan file-nya masih ada di server
            if (file_exists($pathLama)) {
                unlink($pathLama);
            }

            // Proses upload thumbnail baru
            $file = $request->file('logo');
            $nama_logo = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/data/client'), $nama_logo);

            // Simpan nama file baru ke database
            $data->logo_client = $nama_logo;
        }
        $data->update();

        return redirect()->route('adminClient')->with('success', 'Client berhasil diubah');
    }

    public function delete($id){
        $data = Client::find($id);
        if(!$data){
            return response()->json(['message' => 'Client tidak ditemukan'], 404);
        }

        if($data->logo_client){
            $path = public_path('img/data/client/' . $data->logo_client);
            if(File::exists($path)){
                File::delete($path);
            }
        }

        $data->delete();

        return response()->json(['message' => 'Client berhasil dihapus']);
    }
}
