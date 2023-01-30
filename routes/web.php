<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $images = DB::table('images')
        ->select('*')
        ->get();
    $myImages = $images->all();
    return view('welcome', ['imagesInView' => $myImages]);
});

Route::get('/about',function (){
    return view('about');
});

Route::get('/create',function (){
    return view('create');
});

Route::post('/store', function (Request $request){
    $image = $request->file('image');
    $filename = $request->image->store('uploads');

    DB::table('images')->insert(
        ['image'=>$filename]
    );
    return redirect('/');
});

Route::get('/show/{id}',function ($id){
    $image = DB::table('images')
        ->select('*')
        ->where('id', $id)
        ->first();
    $myImage = $image->image;

    return view('show', ['imageInView' => $myImage]);
});

Route::get('/edit/{id}', function ($id){
    $myImage = DB::table('images')
        ->select('*')
        ->where('id', $id)
        ->first();


    return view('/edit', ['imageInView'=>$myImage]);
});

Route::post('/update/{id}', function ($id, Request $request){
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
});
