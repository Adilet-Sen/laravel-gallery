<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    function index() {
        $images = DB::table('images')
            ->select('*')
            ->get();
        $myImages = $images->all();
        return view('welcome', ['imagesInView' => $myImages]);
    }

    function about(){
        return view('about');
    }

    function create(){
        return view('create');
    }

    function store(Request $request){
        $filename = $request->image->store('uploads');

        DB::table('images')->insert(
            ['image'=>$filename]
        );
        return redirect('/');
    }

    function show($id){
        $image = DB::table('images')
            ->select('*')
            ->where('id', $id)
            ->first();
        $myImage = $image->image;

        return view('show', ['imageInView' => $myImage]);
    }

    function edit($id){
        $myImage = DB::table('images')
            ->select('*')
            ->where('id', $id)
            ->first();


        return view('/edit', ['imageInView'=>$myImage]);
    }

    function update($id, Request $request){
        $myImage = DB::table('images')
            ->select('*')
            ->where('id', $id)
            ->first();
        $fileName = $request->image->store('uploads');
        Storage::delete($myImage->image);
        DB::table('images')
            ->where('id', $id)
            ->update(['image' => $fileName]);

        return redirect('/');
    }

    function delete($id){
        $myImage = DB::table('images')
            ->select('*')
            ->where('id', $id)
            ->first();
        Storage::delete($myImage->image);
        DB::table('images')->where('id',$id)->delete();
        return redirect('/');
    }
}
