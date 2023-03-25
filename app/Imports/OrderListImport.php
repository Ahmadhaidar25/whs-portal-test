<?php

namespace App\Imports;

use App\Models\OrderList;
use Maatwebsite\Excel\Concerns\ToModel;

class OrderListImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new OrderList([
            
        ]);
    }
}
