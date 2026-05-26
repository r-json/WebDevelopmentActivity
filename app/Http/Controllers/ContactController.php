<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact(){
        //return "<a href= '". route('aboutMe') ."'> Go to About</a>";
        return "Keep up with us. Contact us.";
    }
}