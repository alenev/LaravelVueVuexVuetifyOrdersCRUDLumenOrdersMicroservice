<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    public function ApiResponceSuccess(string|array|object $data, int $code = 200):JsonResponse
    {
        if($code < 200 || $code  > 299)
        {

            return response()->json(['error' => "success response code not valid"] , 406);

        }


        if(empty($data)){
 
              return response()->json(['error' => "success response data is empty"], 404);

        }else{

            if(is_string($data) || is_array($data)){

              return response()->json(['data' => $data], $code);

            }else if(is_object($data)){

                $adata = get_object_vars($data);
                
                if(empty($adata)){

                    return response()->json(['error' => "success response data object is empty"], 404);

                }else{

                    $oadata = [];
                        
                    foreach($adata as $key => $val){
                        
                        $oadata[$key] = $val;

                    }

                    return response()->json(['data' => $data], $code);

                }

            }

             
        }
      
    }

    public function ApiResponceError(string $message, int $code = 200):JsonResponse
    {
        if($code < 300)
        {

        return response()->json(['error' => "error response code not valid"], 406);

        }

        if(empty($message)){

            return response()->json(['error' => "error response message is empty"], 404);
    
        }else{

            return response()->json(['error' => $message], $code);

        }
    }
}
