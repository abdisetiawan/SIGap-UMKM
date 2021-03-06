<?php

namespace App\Http\Controllers;
use \App\Kecamatan;

use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    //
    public function index()
    {
        $data_kecamatan = \App\Kecamatan::all();
        return view('kecamatan.index',compact(['data_kecamatan']));
    }

    public function create(Request $request)
    {
        $this->validate($request,
        [
            'nama_kcmtn' => 'required|unique:kecamatan'
        ],
        [
            'nama_kcmtn.required'   => 'Nama Kecamatan Wajib Di Isi',
            'nama_kcmtn.unique' => 'Nama Kecamatan Sudah Ada'
        ]);

        $kecamatan = \App\Kecamatan::create($request->all());
        return redirect('/kecamatan')->with('sukses','Data sukses diinput');
    }

    public function delete(Kecamatan $kecamatan)
    {
        // metode delete gak pakai parameter
        $kecamatan->delete();
        return redirect('/kecamatan')->with('sukses','Data berhasil di hapus');
    }
    
    public function edit(Kecamatan $kecamatan){
        // pasing data ke views edit
        return view('kecamatan/edit',['kecamatan' => $kecamatan]);
    }

    public function update(Request $request,Kecamatan $kecamatan){
        //dd($request->all());
        $kecamatan->update($request->all());
        return redirect('/kecamatan')->with('sukses','Data sukses diupdate');
    }
}
