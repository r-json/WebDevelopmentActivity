<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class CalculateController extends Controller
{
    public function index($num1, $num2){
   
        Log::info('================== CalculateController START INDEX ================== ');

        Log::debug('Yah Yah');
        $sum = $this->add($num1, $num2); 
        Log::info($num1 . ' + ' . $num2);
        Log::info('sum = ' . $sum);
        
        //dd('Stop');

        $difference = $this->difference($num1, $num2);
        Log::info('difference = ' . $difference);

        Log::info('================== UtilController START  ================== ');
        $util = new UtilController();
        try{
            $product = $util->product($num1, $num2);
            Log::info($num1 . ' * ' . $num2);
            Log::info('product = ' . $product);  

            $quotient = $util->quotient($num1, $num2);
            Log::info($num1 . ' / ' . $num2);
            Log::info('quotient = ' . $quotient);  
        }catch(Throwable $e){
            Log::error('ERROR: ' . $e->getMessage());
        }finally{
            Log::info("Any Message");
        }      
        Log::info('================== UtilController END  ================== ');
        //$quotient = $util->quotient($num1, $num2);

        //return "<h1>Sum: ".$sum." </br> Difference: ".$difference." </br> Product: ".$product."</h1>";
        Log::info('================== CalculateController END INDEX ================== ');
        return view('calculate', compact("sum", "difference", "product"));
    }

    private function add($param1, $param2){
        return $param1 + $param2;
    }

    public function difference($param1, $param2){
        //throw new Exception("Something Went Wrong");
        Log::info($param1 . ' - ' . $param2);
        return $param1 - $param2;
    }
}
