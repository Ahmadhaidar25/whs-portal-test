<?php

namespace App\Imports;

use App\Models\IAMI\Order;
use App\Models\IAMI\OrderList;
use App\Models\IAMI\Label;
use Carbon\Carbon;
use Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class OrderImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $ldatetime = Carbon::now();
      $lday = $ldatetime->format('d');
      $lmonth = $ldatetime->format('m');
      $lyear = $ldatetime->format('Y');
      $lhour = $ldatetime->format('H');
      $lminute = $ldatetime->format('i');
      $lsecond = $ldatetime->format('s');

      $number = 'order_iami' . "_" . $lyear . "_" . $lmonth . "_" . $lday . "_" . $lhour . "_" . $lminute . "_" . $lsecond;
      $created_by = Auth::id();

      $table1 = new Order([
       "number" => $number,
       "order_number" => $row['order_number'], 
       "purchase_order_number" => $row['purchase_order_number'], 
       "order_date" => $row['order_date'],
       "order_time" => $row['order_time'],
       "delivery_cycle" => $row['delivery_cycle'],
       "created_by" => $created_by,

   ]);

      $table2 = new OrderList([
       "order_id" => $row->$table1->id,
       "part_number" => $row['part_number'], 
       "part_name" => $row['part_name'], 
       "total_qty" => $row['total_qty'],
       "total_kanban" => $row['total_kanban'],
       "kanban_qty" => $row['kanban_qty'],
       "lp" => $row['lp'],

   ]);

      $table3 = new Label([
       "order_id" => $row['order_id'],
       "order_list_id" => $row['order_list_id'], 
       "kanban_number" => $row['kanban_number'], 
       "serie_number" => $row['serie_number'],


   ]);

      $tabel1->save();
      $tabel2->save();
      $tabel3->save();


  }
}
