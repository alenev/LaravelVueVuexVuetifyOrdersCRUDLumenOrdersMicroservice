<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OrdersRequest;
use App\Http\Requests\DeleteRequest;
use Illuminate\Http\JsonResponse;
use App\Helpers\DataHelper;
use App\Repositories\OrdersRepository;
use Illuminate\Validation\ValidationException;

class OrdersController extends Controller
{
    public object $orders;
    private object $order;
    private array $orderData;
    private $requestValidateError;

    private OrdersRepository $db;

    public function __construct(OrdersRepository $db){
         $this->db = $db;
    }

    public function getAll(Request $request):JsonResponse
    {
          $this->orders = $this->db->getPaginated($request['limit']);
          return Controller::ApiResponceSuccess($this->orders, 200);
    }

    public function getOrder($id):JsonResponse
    {
        $this->show($id);
        return Controller::ApiResponceSuccess($this->order, 200);
    }

    public function store(Request $request):JsonResponse
    {
        $this->validate($request, [
            'id' => 'required|int',
            'product_name' => 'required|string|min:3',
            'weigth' => 'decimal',
            'description' => 'string',
            'total_price' => 'required|decimal:2'      
        ]);

        $this->requestValidateError = DataHelper::requestValidationErrorsData($request);
        if ($this->requestValidateError) { 
            return Controller::ApiResponceError($this->requestValidateError, 500); 
         }
        $this->orderData = DataHelper::orderDataTransform($request->all());

        $this->order = $this->db->create($this->orderData);

        if ($this->order) {
            $this->show($this->order->id);
            return Controller::ApiResponceSuccess([
                "message" => "order created",
                "order" => $this->order
            ], 200); 

        } else {

            return Controller::ApiResponceError("order update error", 500);

        }
    }

    public function show($id)
    {
        $this->order = $this->db->find($id)->first();
    }

    public function update(Request $request):JsonResponse
    {
        $this->validate($request, [
            'id' => 'required|int',
            'product_name' => 'required|string|min:3',
            'weigth' => 'decimal',
            'description' => 'string',
            'total_price' => 'required|decimal:2'      
        ]);
          
           $this->show($request['id']);
           $this->orderData = DataHelper::orderDataTransform($request->all());

           if($this->order->update($this->orderData)){
              $this->show($request['id']);
              return Controller::ApiResponceSuccess([
                "message" => "order updated",
                "order" => $this->order

            ], 200); 

           }else{

              return Controller::ApiResponceError("order update error", 500);

           }
         
    }


    public function deleteOrder(Request $request):JsonResponse
    {
        $this->validate($request, [
            'id' => 'required|int'
        ]);

        $this->requestValidateError = DataHelper::requestValidationErrorsData($request);

        if ($this->requestValidateError) { 
 
            return Controller::ApiResponceError($this->requestValidateError, 500); 
  
         }

        if($this->db->delete($request["id"])){

            return Controller::ApiResponceSuccess(["message" => "order deleted"], 200); 

         }else{

            return Controller::ApiResponceError("order delete error", 500);

         }
    }
}