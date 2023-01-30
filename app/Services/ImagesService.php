<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImagesService
{
    public function all(){
        $images = DB::table('images')
            ->select('*')
            ->get();
        return $images->all();
    }

    public function add($filename){
        DB::table('images')->insert(
            ['image'=>$filename]
        );
    }

    public function one($id){
        $image = DB::table('images')
            ->select('*')
            ->where('id', $id)
            ->first();
        return $image;
    }

    public function update($id, $image){
        $myImage = $this->one($id);
        Storage::delete($myImage->image);
        $fileName = $image->store('uploads');
        DB::table('images')
            ->where('id', $id)
            ->update(['image' => $fileName]);
    }

    public function delete($id){
        $myImage = $this->one($id);
        Storage::delete($myImage->image);
        DB::table('images')->where('id',$id)->delete();
    }
}
