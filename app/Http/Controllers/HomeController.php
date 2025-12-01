<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Galeri;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController
{
    public function index(){
        $kategori = Kategori::all()->sortByDesc('created_at')->take(10);
        $kategoriAll = Kategori::all()->sortByDesc('created_at');
        $client = Client::all()->sortByDesc('created_at');
        $testimoni = Testimoni::all()->sortByDesc('created_at');
        $galleries = Galeri::all()->sortByDesc('created_at')->take(9);
        $count = count($galleries);

        return view('user.home.home', compact('kategori', 'kategoriAll', 'client', 'testimoni', 'galleries', 'count'));
    }

    public function galeri(){
        $kategoriAll = Kategori::all()->sortByDesc('created_at');
        $galleries = Galeri::all()->sortByDesc('created_at');

        return view('user.home.galeri.list', compact('kategoriAll','galleries'));
    }

    public function product(Request $request){
        $kategoriAll = Kategori::all()->sortByDesc('created_at');
        $query = Produk::query();

        if ($request->has('kategori')) {
            // Filter berdasarkan kategori yang dipilih
            $kategori = Kategori::where('nama_kategori', $request->kategori)->first();
            $query->where('kategori_id', $kategori->id);
        }

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            // Contoh: cari berdasarkan nama produk, bisa sesuaikan kolomnya
            $query->where('nama_produk', 'LIKE', '%' . $searchTerm . '%');
        }

        $listFilter = [
            'terbaru' => fn($query) => $query->orderByDesc('created_at'),
            'terlama' => fn($query) => $query->orderBy('created_at', 'asc'),
            'termurah' => fn($query) => $query->orderBy('harga', 'asc'),
            'termahal' => fn($query) => $query->orderBy('harga', 'desc'),
        ];

        if ($request->filled('listFilter') && isset($listFilter[$request->listFilter])) {
            $listFilter[$request->listFilter]($query);
        }

        if ($request->filled('price_range')) {
            $priceRanges = $request->input('price_range');

            $query->where(function ($q) use ($priceRanges) {
                foreach ($priceRanges as $range) {
                    if ($range == '0-100000') {
                        $q->orWhereBetween('harga', [0, 100000]);
                    } elseif ($range == '100000-500000') {
                        $q->orWhereBetween('harga', [100000, 500000]);
                    } elseif ($range == '500000-') {
                        $q->orWhere('harga', '>=', 500000);
                    }
                }
            });
        }

        // Eksekusi query dan urutkan berdasarkan created_at descending
        $produk = $query->orderByDesc('created_at')->get();
        $data = Produk::all()->count();

        return view('user.shop.stuff', compact('kategoriAll', 'produk', 'data'));
    }

    public function detail(Request $request, $id)
    {
        $kategoriAll = Kategori::all()->sortByDesc('created_at');
        $produk = Produk::findOrFail($id);
        $rekomendasi = Produk::where('kategori_id', $produk->kategori_id)
                        ->where('id', '!=', $produk->id)
                        ->latest()
                        ->take(4)
                        ->get();

        return view('user.shop.detail', compact('kategoriAll', 'produk', 'rekomendasi'));
    }

}
