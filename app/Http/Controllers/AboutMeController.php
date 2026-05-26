<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutMeController extends Controller
{
    public function aboutMe($id, $name){
        return "<a href= '". route('home.show', ['id'=>$id, 'name'=>$name]) ."'> Go to home</a>";
    }
}