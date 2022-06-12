<?php

namespace App\Http\Controllers;

use App\Models\Addres;
use App\Models\Cart;
use App\Models\Country;
use App\Models\Zone;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Array_;



class CartController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart=new Cart();
        $cart->user_id=auth()->check() ? auth()->id() : 0;
        $cart->session_id=session()->getId();
        $cart->product_id=$request->pid;
        $cart->variant_id=$request->pvid;
        $cart->quantity=$request->quantity;




        if ( $cart->save()) {

            $success = true;
            $message =  "Sepete Eklendi";
        } else {
            $success = false;
            $message = "Üretici Bulunamadı";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if (auth()->check())
        {
            $data=DB::select("SELECT
	products.model,
	products.id,
	products.price,
	products.name,
	products.image,
	products.currency_id,
	products.tax_id,
	products.sku,
	carts.quantity,
	carts.variant_id,
	(products.price * carts.quantity) as total


FROM
	carts
	INNER JOIN
	products
	ON
		carts.product_id = products.id
WHERE
	carts.user_id = $id
	");

            $variant=[];
            for ($i=0;$i<count($data);$i++)
            {
                if ($data[$i]->variant_id!=null) {
                    $in = $data[$i]->variant_id;
                    $sorgu = DB::select("SELECT
	variants.name as vname,
	variant_options.name as oname,
	product_variants.sku,
	product_variants.price,
	product_variants.quantity,
		product_variants.id
FROM
	product_variants
	INNER JOIN
	variants
	ON
		product_variants.variant_id = variants.id
	INNER JOIN
	variant_options
	ON
		product_variants.variant_options_id = variant_options.id
WHERE
	product_variants.id IN ($in)");

                    $variant[$i] = $sorgu;


                }
                else
                {
                    $variant[$i]=null;
                }




            }


            foreach ($data as $key=>$value)
            {
                $total=0;
                $subtotal=1;
                $value->variants=$variant[$key];
                if ($variant[$key]) {
                    foreach ($variant[$key] as $v) {
                        $total += $v->price;


                    }


                }
                else
                {
                    $total=$value->price;

                }

                $value->variantsprice=$total;

            }
        }
        else
        {
            $data=Cart::where('user_id',$id)->get();
        }



        return view ('cart',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkout()
    {
        if (Auth::check())
        {
            $id=Auth::id();
            $data=DB::select("SELECT
	products.model,
	products.id,
	products.price,
	products.name,
	products.image,
	products.currency_id,
	products.tax_id,
	products.sku,
	carts.quantity,
	carts.variant_id,
	(products.price * carts.quantity) as total


FROM
	carts
	INNER JOIN
	products
	ON
		carts.product_id = products.id
WHERE
	carts.user_id = $id
	");

            $variant=[];
            for ($i=0;$i<count($data);$i++)
            {
                if ($data[$i]->variant_id!=null) {
                    $in = $data[$i]->variant_id;
                    $sorgu = DB::select("SELECT
	variants.name as vname,
	variant_options.name as oname,
	product_variants.sku,
	product_variants.price,
	product_variants.quantity,
		product_variants.id
FROM
	product_variants
	INNER JOIN
	variants
	ON
		product_variants.variant_id = variants.id
	INNER JOIN
	variant_options
	ON
		product_variants.variant_options_id = variant_options.id
WHERE
	product_variants.id IN ($in)");

                    $variant[$i] = $sorgu;


                }
                else
                {
                    $variant[$i]=null;
                }




            }


            foreach ($data as $key=>$value)
            {
                $total=0;
                $subtotal=1;
                $value->variants=$variant[$key];
                if ($variant[$key]) {
                    foreach ($variant[$key] as $v) {
                        $total += $v->price;


                    }


                }
                else
                {
                    $total=$value->price;

                }

                $value->variantsprice=$total;

            }
            $adres=Addres::get();
            $country=Country::all();
            $zone=Zone::where('country_id','=','81')->get();

            session()->put('cart', $data);



            return view('checkout',['data'=>$data,'adres'=>$adres,'country'=>$country,'zone'=>$zone]);
        }
        else
        {
            return redirect("/login");
        }

    }






}
