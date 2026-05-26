<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilController extends Controller
{
    public function sum ($num1, $num2)
    {
        return $num1 + $num2;
    }

    public function difference($num1, $num2)
    {
        return $num1 - $num2;
    }

    public function product($num1, $num2)
    {
        return $num1 * $num2;
    }

    public function quotient($num1, $num2)
    {
        return $num1 / $num2;
    }
}
