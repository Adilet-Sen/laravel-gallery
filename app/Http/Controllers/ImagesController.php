<?php

namespace App\Http\Controllers;

use App\Services\ImagesService;
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
        $this->images->add($request->image->store('uploads'));
        return redirect('/');
    }

    function show($id){
        return view('show', ['imageInView' => $this->images->one($id)->image]);
    }

    function edit($id){
        $myImage = $this->images->one($id);
        return view('/edit', ['imageInView'=>$myImage]);
    }

    function update($id, Request $request){
        $this->images->update($id, $request->image);
        return redirect('/');
    }

    function delete($id){
        $this->images->delete($id);
        return redirect('/');
    }
}
