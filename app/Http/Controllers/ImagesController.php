<?php

namespace App\Http\Controllers;

use App\Services\ImagesService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    private $images;
    public function __construct(ImagesService $imagesService)
    {
        $this->images = $imagesService;
    }

    function index() {
        return view('welcome', ['imagesInView' => $this->images->all()]);
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
