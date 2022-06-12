<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $data=DB::select("SELECT
	addres.adress,
	addres.city,
	users.name AS uname,
	users.email,
	orders.tracking,
	orders.comment,
	orders.amount,
	orders.payment_id,
	orders.status,
	orders.payment_status,
	orders.id,
	addres.country_id AS country,
	addres.zone_id AS zone,
	addres.postcode as postcode
FROM
	orders
	INNER JOIN
	users
	ON
		orders.user_id = users.id
	INNER JOIN
	addres
	ON
		orders.adress_id = addres.id");

       return view('backend.order.index',['data'=>$data]);
    }

    public function show($id)
    {
            $data=OrderProduct::where('order_id',$id)->get();
            $order=DB::select("SELECT
	addres.adress,
	addres.city,
	users.name AS uname,
	users.email,
	orders.tracking,
	orders.comment,
	orders.amount,
	orders.payment_id,
	orders.status,
	orders.payment_status,
	orders.id,
	addres.country_id AS country,
	addres.zone_id AS zone,
	addres.postcode AS postcode,
    orders.created_at
FROM
	orders
	INNER JOIN
	users
	ON
		orders.user_id = users.id
	INNER JOIN
	addres
	ON
		orders.adress_id = addres.id
WHERE
	orders.id = $id");


        return view('backend.order.detail',['data'=>$data,'order'=>$order]);



    }
}
