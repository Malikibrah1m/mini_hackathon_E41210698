<?php

namespace App\Http\Controllers;

use App\Models\Daftar_ektp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarController extends Controller
{   // menampilkan data
    public function index (){
        $daftar_ektp = Daftar_ektp::get();
        return view('backend.daftar_ektp.index',compact('daftar_ektp'));
    }
    //menambah data
    public function create (){
        $daftar_ektp = null;
        return view('backend.daftar_ektp.index',compact('daftar_ektp'));
    }
    public function store (Request $request){
        Daftar_ektp::create($request->all());
        return redirect()->route('daftar_ektp.index')
                        ->with('success','Data E-KTP baru telah ditambahkan');
    }
    //menghapus data
    public function destroy($id)
    {
        $daftar_ektp = Daftar_ektp::find($id);
        $daftar_ektp->delete();
        return redirect()->route('daftar_ektp.index')
                        ->with('success', 'Data E-KTP telah dihapus');
    }
    //mengedit data
    public function edit($id)
    {
        $daftar_ektp = Daftar_ektp::find($id);
        return view('backend.daftar_ektp.edit', compact('daftar_ektp'));
    }

    public function update(Request $request, $id)
    {
        $daftar_ektp = Daftar_ektp::find($id);
        $daftar_ektp->update($request->all());
        return redirect()->route('daftar_ektp.index')
                        ->with('success', 'Data E-KTP telah diperbarui');
    }
}
