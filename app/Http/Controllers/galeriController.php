<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Galeri;
use App\KategoriGaleri;
use DB;
use Mockery\Exception;

class GaleriController extends Controller
{
    public function index(){
        $listGaleri=Galeri::all();
            
        return view('galeri.index', compact('listGaleri'));
        
        }
    
        public function show($id){
            $galeri=Galeri::find($id);
    
            return view('galeri.show',compact('galeri'));
        }

        public function create(){
            $kategoriGaleri= KategoriGaleri::pluck('nama','id');

            return view('galeri.create',compact('kategoriGaleri'));
        }
    
        public function store(Request $request){
        
            DB::transaction(function () use ($request){
            $input= $request->except('path');
    
            $galeri=Galeri::create($input);

            if ($request->has('path')){
                $file=$request->file('path');
                $filename=$galeri->id.'.'.$file->getClientOriginalExtension();
                $path=$request->path->storeAs('public/galeri',$filename,'local');
                $galeri->path="storage". substr($path,strpos($path,'/'));
                $galeri->save();
            }
        }, 5);
    
            return redirect(route('galeri.index'));
        }

        public function edit($id){
            $galeri=Galeri::find($id);
            $kategoriGaleri= kategoriGaleri::pluck('nama','id');
    
            if(empty($galeri)){
                return redirect(route('galeri.index'));
            }
    
            return view('galeri.edit',compact('galeri','kategoriGaleri'));
        }
    
        public function update($id,Request $request){
            $Galeri=Galeri::find($id);
    
            $input=$request->all();
    
            if(empty($Galeri)){
                return redirect(route('galeri.index'));
            }
    
            $Galeri->update($input);
    
            return redirect(route('galeri.index'));
    
        }

        public function destroy($id){
            $Galeri=Galeri::find($id);
    
    
            if(empty($Galeri)){
                return redirect(route('galeri.index'));
            }
    
            $Galeri->delete();
    
            return redirect(route('galeri.index'));
    
        }
}