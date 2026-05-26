<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FallbackController extends Controller
{
    public function fallback(){
        return response()->file(public_path('PicWithSirAJ.png'));
    }
}