<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


class CompressorController extends Controller
{
    public function compress(Request $request)
    {
        $str = $request->input('string');        
        $arr = str_split($str);
        $count = count($arr);       
        $compress = '';

        for($i=0; $i<$count; $i++){            
            if($i+1 == $count){
                $compress .= $arr[$i];
            } else {                    
                if($arr[$i] == $arr[$i+1] && isset($arr[$i+2]) && $arr[$i+1] == $arr[$i+2]){                    
                    $compress .= "3$arr[$i]";
                    $i= $i+2;                    
                } else {                   
                    $compress .= $arr[$i];
                }                
            }            
        }
        
        return response()->json($compress);

    }
   
}