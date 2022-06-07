<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Brand::get();
        return view('backend.brands.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.brands.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('image'))
        {
            $validatedData = $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1024',
            ],
            );
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/brand'), $imageName);
            $path="/images/brand/".$imageName;

        }
        else
        {
            $path="/upload/kategori.png";

        }

        $data=new Brand();
        $data->name=$request->name;
        $data->image=$path;
        if ($data->save()) {

            return redirect()->route('admin.brands.list')->with('success','Üretici Başarıyla Eklendi.');
        }
        else
        {
            return redirect()->route('admin.brands.create')->with('error','Üretici Eklenirken Hata Oluştu.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand,$id)
    {
        $data=Brand::find($id);

        return view('backend.brands.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand,$id)
    {
        $data=Brand::find($id);
        $pathX=$data->image;
        if($request->hasFile('image'))
        {
            $validatedData = $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1024',
            ],
            );

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/brand'), $imageName);
            $path="/images/brand/".$imageName;
            $data->image=$path;

        }
        else
        {
            $path="/upload/kategori.png";

        }


        $data->name=$request->name;



        if ($data->save()) {

            File::delete(public_path($pathX));
            return redirect()->route('admin.brands.list')->with('success','Üretici Başarıyla Güncellendi.');
        }
        else
        {
            return redirect()->route('admin.brands.list')->with('error','Üretici Güncellenirken Hata Oluştu.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand,$id)
    {
        $image = Brand::find($id);
        $path=$image->image;
        $delete=Brand::destroy($id);

        // check data deleted or not
        if ($delete == 1) {

            File::delete(public_path($path));

            $success = true;
            $message = "Üretici Başarıyla Silindi";
        } else {
            $success = true;
            $message = "Üretici Bulunamadı";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
