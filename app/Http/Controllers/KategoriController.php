<?php

namespace App\Http\Controllers;
use \App\Kategori;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    //
    public function index()
    {
        $data_kategori = \App\Kategori::all();
        return view('kategori.index',compact(['data_kategori']));
    }

    public function create(Request $request)
    {
        $this->validate($request,
        [
            'nama_ktgr' => 'required|unique:kategori'
        ],
        [
            'nama_ktgr.required'   => 'Kategori Wajib Di Isi',
            'nama_ktgr.unique' => 'Kategori Sudah Ada',
        ]);

        $kategori = \App\Kategori::create($request->all());
        $kategori->save();
        return redirect('/kategori')->with('sukses','Data sukses diinput');
    }

    public function delete(Kategori $kategori)
    {
        // metode delete gak pakai parameter
        $kategori->delete();
        return redirect('/kategori')->with('sukses','Data berhasil di hapus');
    }

    public function edit(Kategori $kategori){
        // pasing data ke views edit
        return view('kategori/edit',['kategori' => $kategori]);
    }

    public function update(Request $request,Kategori $kategori){
        //dd($request->all());
        $kategori->update($request->all());
        if($request->hasFile('logo')){
            $request->file('logo')->move('images/',$request->file('logo')->getClientOriginalName());
            $kategori->logo = $request->file('logo')->getClientOriginalName();
            $kategori->save();
        }
        return redirect('/kategori')->with('sukses','Data sukses diupdate');
    }

}
