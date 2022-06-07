<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Currency;
use App\Models\gallery;
use App\Models\Product;
use App\Models\ProductVariants;
use App\Models\Tax;
use App\Models\VariantOptions;
use App\Models\Variants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use mysql_xdevapi\Table;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Product::where('status',1)->get();
        return view('backend.product.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $catList=Category::with('children')->get();
        $tax=Tax::get();
        $currency=Currency::get();
        $brand=Brand::get();

        return view('backend.product.add',['catList'=>$catList,'tax'=>$tax,'currency'=>$currency,'brand'=>$brand]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'model' => 'required',
        ],[
            'name.required' => 'Bu Alan Gereklidir.',
            'model.required' => 'Bu Alan Gereklidir.',
        ]);

        $data=new Product();
        $data->brand_id=$request->brand;
        $data->category_id=$request->category;
        $data->tax_id=$request->tax;
        $data->currency_id=$request->currency;
        $data->currency_id=$request->currency;
        $data->model=$request->model;
        $data->sku=$request->sku;
        $data->quantity=$request->quantity;
        $data->price=$request->price;
        $data->discount_price=$request->discount_price;
        $data->purchase_price=$request->purchase_price;
        $data->name=$request->name;
        $data->description=$request->description;
        $data->image=$request->image;
        $data->weight=$request->weight;
        $data->length=$request->length;
        $data->width=$request->width;
        $data->height=$request->height;
        $data->meta_title=$request->meta_title;
        $data->meta_description=$request->meta_description;
        $data->meta_keyword=$request->meta_keyword;
        $data->slug=$request->slug;
        if($request->hasFile('image'))
        {
            $validatedData = $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1024',
            ],
            );

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/product'), $imageName);
            $path="/images/product/".$imageName;

        }
        else
        {
            $path="/placeholder.jpg";

        }
        $data->image=$path;

        if ($data->save()) {

            return redirect()->route('admin.product.list')->with('success','ürün Başarıyla Eklendi.');
        }
        else
        {
            return redirect()->route('admin.product.list')->with('error','Ürün Eklenirken Hata Oluştu.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function gallery(Product $product,$id)
    {


        return view('backend.product.gallery',['id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product,$id)
    {

        $catList=Category::with('children')->get();
        $tax=Tax::get();
        $currency=Currency::get();
        $brand=Brand::get();
        $data=Product::find($id);

        return view('backend.product.edit',['catList'=>$catList,'tax'=>$tax,'currency'=>$currency,'brand'=>$brand,'data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product,$id)
    {


        $this->validate($request,[
            'name' => 'required',
            'model' => 'required',
        ],[
            'name.required' => 'Bu Alan Gereklidir.',
            'model.required' => 'Bu Alan Gereklidir.',
        ]);

        $data=Product::find($id);
        $data->brand_id=$request->brand;
        $data->category_id=$request->category;
        $data->tax_id=$request->tax;
        $data->currency_id=$request->currency;
        $data->currency_id=$request->currency;
        $data->model=$request->model;
        $data->sku=$request->sku;
        $data->quantity=$request->quantity;
        $data->price=$request->price;
        $data->discount_price=$request->discount_price;
        $data->purchase_price=$request->purchase_price;
        $data->name=$request->name;
        $data->description=$request->description;
        $data->image=$request->image;
        $data->weight=$request->weight;
        $data->length=$request->length;
        $data->width=$request->width;
        $data->height=$request->height;
        $data->meta_title=$request->meta_title;
        $data->meta_description=$request->meta_description;
        $data->meta_keyword=$request->meta_keyword;
        $data->slug=$request->slug;
        if ($data->save()) {

            return redirect()->route('admin.product.list')->with('success','ürün Başarıyla Güncellendi.');
        }
        else
        {
            return redirect()->route('admin.product.list')->with('error','Ürün Güncellenirken Hata Oluştu.');
        };

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product,$id)
    {
        $image = gallery::where('pid',$id)->get();
        foreach ($image as $del)
        {

            File::delete(public_path($del->image));
        }

        gallery::where('pid',$id)->delete();
        ProductVariants::where('product_id',$id)->delete();


        $product = Product::find($id);
        $path=$product->image;
        $delete=Product::destroy($id);

        // check data deleted or not
        if ($delete == 1) {

            File::delete(public_path($path));

            $success = true;
            $message = "ürün Başarıyla Silindi";
        } else {
            $success = true;
            $message = "Ürün Bulunamadı";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);


    }

    public function variants($id)
    {
        $sql="SELECT
	product_variants.id,
	variants.id AS vid,
	variants.name AS vname,
	product_variants.product_id,
	product_variants.variant_options_id,
	variant_options.name,
	product_variants.sku,
	product_variants.quantity,
	product_variants.price_prefix,
	product_variants.price,
	currencies.name as cname,
	currencies.code as code,
	currencies.symbol as csymbol,
	product_variants.currency_id
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
	INNER JOIN
	currencies
	ON
		product_variants.currency_id = currencies.id
WHERE
	product_variants.product_id = $id";

       $vlist=DB::select($sql);





        $data=Variants::get();
        $currency=Currency::get();

        $count=count($data);
        $vo=VariantOptions::get();


        return view ('backend.product.variants',['id'=>$id,'data'=>$data,'count'=>$count,'vo'=>$vo,'vlist'=>$vlist,'currency'=>$currency]);

    }

    public function addvariants(Request $request)
    {

        $say=count($request->all())-1;


      for ($i=0;$i<$say;$i++)
      {


          foreach ((array)$request->$i as $rs)
          {


              if ($rs['vid']!=null)
              {
                  $vid=$rs['vid'];
              }
              $data=new ProductVariants();
              $data->variant_options_id=$rs['options'];
              $data->variant_id=$vid;
              $data->product_id=$request->pid;
              $data->currency_id=$rs['currency'];
              $data->price=$rs['price'];
              $data->quantity=$rs['quantity'];
              $data->price_prefix=$rs['price_prefix'];

              $kontrol=ProductVariants::where('product_id', '=', $request->pid)
                                      ->where('variant_options_id', '=', $rs['options'])->get();
              if (count($kontrol)<1)
              {
                  $data->save();
              }


          }

      }


        return redirect()->route('admin.product.list')->with('success','Başarıyla Eklendi.');



    }


    function upload(Request $request)
    {

        $image = $request->file('file');
        $id=$request->id;
        $imageName = 'i'.Str::random(6). '.' . $image->extension();
        if($image->move(public_path("images/product/$id"), $imageName));
        {
            $path="/images/product/".$id.'/'.$imageName;
            $data=new gallery();
            $data->pid=$id;
            $data->image=$path;
            $data->save();
            return response()->json(['success' => $imageName]);
        }

    }


    function fetch($id)
    {



        $images=gallery::where('pid',$id)->get();
        $output = '<div class="row">';
        foreach($images as $image)
        {
            $output .= '
      <div class="col-md-2" style="margin-bottom:16px;" align="center">
                <img src="'.asset( $image['image']).'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
                <input type="hidden" name="rid" id="rid" value="'.$image['id'].'">
                <button type="button" class="btn btn-link remove_image" onclick="deletex('.$image['id'].')"><i title="Sil"
                                                                class="fa fa-trash" aria-hidden="true"></i></button>
            </div>
      ';
        }
        $output .= '</div>';
        echo $output;
    }

    function delete(Request $request)
    {
        if($request->get('id'))
        {
            $img=gallery::find($request->get('id'));
            File::delete(public_path($img->image));
            gallery::destroy($request->get('id'));

        }
    }

    function vdelete(Request $request,$id)
    {
        $delete=ProductVariants::destroy($id);

        if ($delete == 1) {


            $success = true;
            $message = "Başarıyla Silindi";
        } else {
            $success = true;
            $message = "Hata Oluştu";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }


    function  variantsfetch($id)
    {

        $vo=VariantOptions::where('variants_id',$id)->get();




        $output=' <select class="form-control" name="voptions" id="voptions">';

        foreach($vo as $rs)
        {
            $output.="<option value='$rs->id'>$rs->name</option>";
        }

        $output.='</select><input type="hidden" name="variant_id[]" value="{{$id}}">';

        echo $output;




    }


    public function variantspriceupdate(Request $request,$id)
    {
        DB::table('product_variants')
            ->where('id', $id)
            ->update(['price' => $request->price]);
    }

    public function prefixupdate(Request $request,$id)
    {
        DB::table('product_variants')
            ->where('id', $id)
            ->update(['price_prefix' => $request->prefix]);
    }

}
