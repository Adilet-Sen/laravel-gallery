<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ImagesService
{
    public function all(){
        $images = DB::table('images')
            ->select('*')
            ->get();
        return $images->all();
    }


}
