<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


//panggil model BukuModel
use App\Models\BukuModel;

class BukuController extends Controller
{
    //method untuk tampil data buku tanpa login
    public function databuku()
    {
        $databuku = BukuModel::orderby('kode_buku', 'ASC')
        ->paginate(5);

        return view('halaman.databuku',['buku'=>$databuku]);
    }
    //method untuk tampil data buku dengan login
    public function bukutampil()
    {
        $databuku = BukuModel::orderby('kode_buku', 'ASC')
        ->paginate(5);

        return view('halaman/view_buku',['buku'=>$databuku]);
    }
    
    //method untuk tambah data buku
    public function bukutambah(Request $request)
    {
        $this->validate($request, [
            'kode_buku' => 'required',
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'image' => 'required',
        ]);
        $path = $request->file('image')->store('public/images');
        BukuModel::create([
            'kode_buku' => $request->kode_buku,
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'image' => $path,
        ]);

        return redirect('/buku');
    }

    //method untuk hapus data buku
    public function bukuhapus($id_buku)
    {
        $databuku=BukuModel::find($id_buku);
        $databuku->delete();

        return redirect()->back();
    }

    //method untuk edit data buku
    public function bukuedit($id_buku, Request $request)
    {
        $this->validate($request, [
            'kode_buku' => 'required',
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // tambahkan validasi untuk tipe dan ukuran gambar
        ]);
    
        $id_buku = BukuModel::find($id_buku);
    
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($id_buku->image) {
                Storage::delete('public/'.$id_buku->image);
            }
    
            // Simpan gambar baru di folder public/
            $image = $request->file('image')->store('public');
            $image = str_replace('public/', '', $image);
    
            // Update data buku dengan gambar baru
            $id_buku->image  = $image;
        }
    
        // Update data buku dengan data baru (termasuk gambar jika ada)
        $id_buku->kode_buku = $request->kode_buku;
        $id_buku->judul     = $request->judul;
        $id_buku->pengarang = $request->pengarang;
        $id_buku->penerbit  = $request->penerbit;
        $id_buku->save();
    
        return redirect()->back();
    }
    
}