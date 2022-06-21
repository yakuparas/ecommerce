<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Backend\CategoryController;
use App\Models\Addres;
use App\Models\Adress;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Country;
use App\Models\gallery;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\settings;
use App\Models\slider;
use App\Models\User;
use App\Models\VariantOptions;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{


    public static function getsettings()
    {
        return settings::first();
    }

    public static function CatList()
    {
        return $catList = Category::where('parent_id', '=', 0)->with('children')->get();
    }

    public static function lastmodal()
    {
        return $lastmodal = Product::limit(4)->orderByDesc('id')->get();
    }


    public static function getCart()
    {
        if (auth()->check()) {
            return $cart = Cart::where('user_id', auth()->id())->get();
        } else {
            return $cart = Cart::where('session_id', session()->getId())->get();
        }


    }


    public function index()
    {

        $slide = slider::get();
        $last = Product::limit(6)->orderByDesc('id')->get();

        return view('index', ['slide' => $slide, 'last' => $last]);
    }


    public function login()
    {
        return view('login');
    }

    public function checkLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {
            return redirect()->route('index')->with('success', 'Giriş Yaptınız');
        }

        return redirect()->route('login')->with('error', 'Kullanıcı Adı veya Şifre Yanlış');

    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }

    public function product($id)
    {
        $data = Product::find($id);
        dd($data);


    }

    public function categoryproducts($id)
    {
        $data = Product::where('category_id', $id)->get();


        $cat = Category::find($id);
        return view('category', ['data' => $data, 'cat' => $cat]);
    }

    public function productdetail($id)
    {
        $data = Product::find($id);
        $last = Product::limit(6)->orderByDesc('id')->get();
        $imagelist = gallery::where('pid', $id)->get();

        $variants = DB::select("SELECT DISTINCT
	product_variants.variant_id,
	variants.name
FROM
	product_variants
	INNER JOIN
	variants
	ON
		product_variants.variant_id = variants.id
WHERE
	product_variants.product_id = $id");

        $options = DB::select("SELECT DISTINCT
	variant_options.variants_id,
	variant_options.name,
	variant_options.image,
	product_variants.sku,
	product_variants.quantity,
	product_variants.price_prefix,
	product_variants.price,
	variant_options.id AS oid,
	product_variants.id as pvid
FROM
	product_variants
	INNER JOIN
	variant_options
	ON
		product_variants.variant_options_id = variant_options.id
WHERE
	product_variants.product_id = $id");


        return view('productdetail', ['data' => $data, 'imagelist' => $imagelist, 'last' => $last, 'variants' => $variants, 'options' => $options]);

    }


    public function profile()
    {
        $country = Country::all();
        $zone = Zone::where('country_id', '=', '81')->get();

        $adres = Addres::get();

        $order = Order::where('user_id', Auth::id())->get();


        return view('account', ['country' => $country, 'zone' => $zone, 'adres' => $adres, 'order' => $order]);
    }

    public function profileupdate(Request $request)
    {

        $id = Auth::user()->id;
        $user = User::find($id);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->phone = $request->phone;
        if ($request->password != null) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
    }

    public function createadres(Request $request)
    {
        $adress = new Addres();
        $adress->user_id = Auth::id();
        $adress->name = $request->name;
        $adress->adress = $request->address;
        $adress->city = $request->city;
        $adress->postcode = $request->postcode;
        $adress->country_id = $request->country;
        $adress->zone_id = $request->zone;
        $adress->save();


        return redirect()->route('profile');

    }

    public function editadress(Request $request)
    {
        $adres = Addres::where('id', '=', $request->id)->get();
        $success = true;
        return response()->json([
            'success' => $success,
            'name' => $adres[0]['name'],
            'adress' => $adres[0]['adress'],
            'city' => $adres[0]['city'],
            'postcode' => $adres[0]['postcode'],
            'country_id' => $adres[0]['country_id'],
            'zone_id' => $adres[0]['zone_id'],
        ]);
    }

    public function destroyadress(Request $request, $id)
    {
        $del = Addres::where('id', '=', $id)->delete();

        if ($del) {


            return redirect()->route('profile');


        }

    }

    public function orderdetail(Request $request)
    {

        $order=OrderProduct::where('order_id',$request->id)->get();
        $success = true;
        return response()->json([
            'success' => $success,
            'data'=>$order
        ]);

    }


    public function zaunplanner(Request $request)
    {
        $data = Product::where('customize','=','1')->get();

        return view('zaunplanner',['data'=>$data]);
    }



    function  variantsfetch($id)
    {

        $vo=DB::select("SELECT
	variant_options.name as voname,
	product_variants.sku,
	product_variants.quantity,
	product_variants.price_prefix as prefix,
	product_variants.price,
	product_variants.currency_id,
	product_variants.id as pvid,
	product_variants.product_id as pid
FROM
	product_variants
	INNER JOIN
	variant_options
	ON
		product_variants.variant_options_id = variant_options.id
WHERE
	product_variants.product_id = $id");




        $output=' <select class="form-control" name="koptions" id="koptions">';

        foreach($vo as $rs)
        {
            $output.="<option data-pid='$rs->pid' data-pvid='$rs->pvid' data-voname='$rs->voname'  data-price='$rs->price' data-prefix='$rs->prefix' value='$rs->pvid'>$rs->voname</option>";
        }

        $output.='</select>';

        echo $output;




    }



    public function step1($id)
    {

        $data = Product::find($id);
        $imagelist = gallery::where('pid', $id)->get();
        $baba=Product::where('category_id','=','12')->get();
        $kapi=Product::where('category_id','=','11')->get();


        $variants = DB::select("SELECT DISTINCT
	product_variants.variant_id,
	variants.name
FROM
	product_variants
	INNER JOIN
	variants
	ON
		product_variants.variant_id = variants.id
WHERE
	product_variants.product_id = $id");

        $options = DB::select("SELECT DISTINCT
	variant_options.variants_id,
	variant_options.name,
	variant_options.image,
	product_variants.sku,
	product_variants.quantity,
	product_variants.price_prefix,
	product_variants.price,
	variant_options.id AS oid,
	product_variants.id as pvid
FROM
	product_variants
	INNER JOIN
	variant_options
	ON
		product_variants.variant_options_id = variant_options.id
WHERE
	product_variants.product_id = $id");


        return view('step', ['data' => $data,'baba'=>$baba,'kapi'=>$kapi, 'imagelist' => $imagelist,'variants' => $variants, 'options' => $options]);
    }

    public function step2(Request $request)
    {

        $request->session()->put('pid',$request->pid);
        $request->session()->put('pvid',$request->pvid);
        $request->session()->put('uzunluk',$request->uzunluk);
        $request->session()->put('kose',$request->kose);
        $request->session()->put('babaid',$request->babaid);
        $request->session()->put('kapiid',$request->kapiid);
        $request->session()->put('kapioptionid',$request->kapioptionid);
        $request->session()->put('kapigenisligi',$request->kapigenisligi);



        return response()->json([
            'success' => true,
            'message' => "Step -2",
        ]);


    }


    public function step3(Request $request)
    {
        $bahceuzunlugu=intval($request->session()->get('uzunluk'))*1000; //mm cinsinden
        $kosesayisi=$request->session()->get('kose');
        $citgenisligi=2500; //mm cinsinden
        $kapigenisligi=$request->session()->get('kapigenisligi');; //mm cinsinden

        $citadet=ceil((($bahceuzunlugu-(7*$kapigenisligi))/2.5)/1000);

        $babadet=($citadet+1)-7;

        echo $citadet;
        echo "<br>";
        echo $babadet;






    }





}
