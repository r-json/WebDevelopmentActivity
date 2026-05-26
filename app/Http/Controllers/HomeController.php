<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        return "<h1> Mabuhay! This is your Home Page. Anything new today? </h1>";
    }

    public function show($id, $name){
        return "<h1> Welcome, to the Home Page, " . $id . " " . $name ." </h1>";
    }
}