<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    protected $appends=['getParentsTree'];

    public static function getParentsTree($category,$title)
    {
        if ($category->parent_id==0) {
           return $title;
        }

        $parent=Category::find($category->parent_id);
        $title=$parent->title.' > '.$title;

        return CategoryController::getParentsTree($parent,$title);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catList=Category::with('children')->get();
        return view('backend.category.index',['catList'=>$catList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catList=Category::with('children')->get();
        return view('backend.category.add',['catList'=>$catList]);
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
            $request->image->move(public_path('images'), $imageName);
            $path="/images/".$imageName;

        }
        else
        {
            $path="/upload/kategori.png";

        }

       $cat=new Category();
       $cat->title=$request->title;
       $cat->parent_id=$request->parent;
       $cat->description=$request->description;
       $cat->seo_url=$request->seourl;
       $cat->keywords=$request->keywords;
       $cat->status=$request->status;
       $cat->image=$path;
       if ($cat->save()) {

        return redirect()->route('admin.category.list')->with('success','Kategori Başarıyla Eklendi.');
       }
       else
       {
        return redirect()->route('admin.category.create')->with('error','Kategori Eklenirken Hata Oluştu.');
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data=Category::find($id);

        $catList=Category::with('children')->get();

        return view('backend.category.edit',['data'=>$data,'catList'=>$catList]);

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
        $data=Category::find($id);
        $pathX=$data->image;
        if($request->hasFile('image'))
        {
            $validatedData = $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1024',
            ],
            );

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $path="/images/".$imageName;
            $data->image=$path;

        }
        else
        {
            $path="/upload/kategori.png";

        }


        $data->title=$request->title;
        $data->parent_id=$request->parent;
        $data->description=$request->description;
        $data->seo_url=$request->seourl;
        $data->keywords=$request->keywords;
        $data->status=$request->status;


        if ($data->save()) {

            File::delete(public_path($pathX));
            return redirect()->route('admin.category.list')->with('success','Kategori Başarıyla Güncellendi.');
           }
           else
           {
            return redirect()->route('admin.category.edit')->with('error','Kategori Güncellenirken Hata Oluştu.');
           }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {




        $image = Category::find($id);
        $path=$image->image;
        $delete=Category::destroy($id);

        // check data deleted or not
        if ($delete == 1) {

            File::delete(public_path($path));

            $success = true;
            $message = "Kategori Başarıyla Silindi";
        } else {
            $success = true;
            $message = "Kategori Bulunamadı";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
