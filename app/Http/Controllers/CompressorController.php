<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


class CompressorController extends Controller
{
    public function compress(Request $request)
    {
        $str = mb_strtolower($request->input('string'));        
        $arr = str_split($str);
        $count = count($arr);       
        $compress = '';
        $item = '';        

        for($i=0; $i<$count; $i++){
            if(isset($arr[$i+1]) && $arr[$i] == $arr[$i+1]){
                $item .= $arr[$i];
            } else {
                $item .= $arr[$i];
                $length = strlen($item);

                if($length>2){                    
                    $compress .= $arr[$i].$length;
                    $item = '';
                } else {                    
                    $compress .= $item;
                    $item = '';
                }
            }
        }

        return response()->json($compress);
    }

    public function decompress(Request $request)
    {       
        $str = mb_strtolower($request->input('string'));        
        $arr = str_split($str);
        $count = count($arr);
        $item = '';
        $decompress = '';        
        
        for($i=0; $i<$count; $i++){
            if(is_numeric($arr[$i])) {                
                for($j=1; $j<$arr[$i]; $j++){
                    $decompress .= $arr[$i-1];
                }
                                
            } else {                
                $decompress .= $arr[$i];
            }
        }

        return response()->json($decompress);

    }
   
}