<?php

namespace App\Helpers;

class DataHelper{

    public static function orderDataTransform(array $order_data):array
    {
        $order_data["weight"] = floatval($order_data["weight"]);

        $order_data["total_price"] = floatval($order_data["total_price"]);

        if($order_data["id"] == 0){

            unset($order_data["id"]);
            
        }

        return $order_data;
    }
    
    public static function requestValidationErrorsData($request)
    {
        if(isset($request->validator) && $request->validator->fails()){

        $validationErrors = $request->validator->errors()->messages();

        $validationErrorsFirst = current((array)$validationErrors);

        return $validationErrorsFirst[0];

        }else{

            return false;

        }
    }

}