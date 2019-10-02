<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KategoriArtikel;

class KategoriArtikelController extends Controller
{
    public function index (){
        $listKategoriArtikel=KategoriArtikel::all();

        return view ('kategori_artikel.index', compact ('listKategoriArtikel'));
    }

    public function show($id){
       // $listKategoriArtikel=KategoriArtikel::where('id',$id)-first();//pakai ini klo nma

       $kategoriArtikel=KategoriArtikel::find($id);

       return view ('kategori_artikel.show', compact ('kategoriArtikel'));
}
}