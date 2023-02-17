<?php

namespace App\Repositories;

use App\Models\Orders;
use App\Repositories\Interfaces\OrdersRepositoryInterface;
class OrdersRepository implements OrdersRepositoryInterface
{
    public function all()
    {
      return Orders::get()->all();

    } 
    public function getPaginated(int $perPage)
    {
        return Orders::paginate($perPage);
    }
    public function create(array $data)
    {
       return Orders::create($data);
    }
    public function update(array $data, $id) 
    {
        return Orders::where('id', $id)->update($data);
    }
    public function delete($id) {
        return Orders::destroy($id);
    }
    public function find($id){
        return Orders::where('id', $id)->get();
    }
}