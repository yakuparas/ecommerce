<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VariantOptions;
use App\Models\Variants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use mysql_xdevapi\TableSelect;



class VariantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Variants::with('options')->get();



        return view('backend.variants.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.variants.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $variants = new Variants();
        $variants->name = $request->title;




        if ($variants->save()) {
            $variants_id = $variants->id;



            for ($i = 0; $i < count($request["variant"]); $i++) {
                if ($request["variant"][$i]["name"] != null) {
                    $options = new VariantOptions();
                    if (isset($request["variant"][$i]["img"])) {
                        if ($request["variant"][$i]["img"]->getType() == "file") {

                            $imageName = time() . '-' . $i . '.' . $request["variant"][$i]["img"]->extension();
                            $request["variant"][$i]["img"]->move(public_path('images/variants'), $imageName);
                            $path = "/images/variants/" . $imageName;
                            $options->image = $path;
                        }
                    }
                    $options->name = $request["variant"][$i]["name"];
                    $options->variants_id = $variants_id;

                    $options->save();
                }
            }
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
        $data = Variants::with('options')->where('id', $id)->get();




        return view('backend.variants.edit', ['data' => $data]);
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
        $data = Variants::find($id);
        $data->name = $request->title;
        $data->save();


        if ($request["variant"] != null)
        {

            for ($i = 0; $i < count($request["variant"]); $i++)
            {
                $options = new VariantOptions();
                if ($request["variant"][$i]["oid"] != null)
                {
                    $opt=VariantOptions::find($request["variant"][$i]["oid"]);






                    $opt->name = $request["variant"][$i]["name"];
                    $opt->variants_id = $id;

                    if (isset($request["variant"][$i]["img"]))
                    {
                        if ($request["variant"][$i]["img"]->getType() == "file") {

                            File::delete(public_path($data->image));

                            $imageName = time() . '-' . $i . '.' . $request["variant"][$i]["img"]->extension();

                            $request["variant"][$i]["img"]->move(public_path('images/variants'), $imageName);
                            $path = "/images/variants/" . $imageName;
                            $opt->image = $path;

                        }
                    }
                    $opt->save();
                }
                else
                {
                    if ($request["variant"][$i]["name"] != null)
                    {
                        if (isset($request["variant"][$i]["img"])) {
                            if ($request["variant"][$i]["img"]->getType() == "file") {

                                $imageName = time() . '-' . $i . '.' . $request["variant"][$i]["img"]->extension();
                                $request["variant"][$i]["img"]->move(public_path('images/variants'), $imageName);
                                $path = "/images/variants/" . $imageName;
                                $options->image = $path;
                            }
                        }
                        $options->name = $request["variant"][$i]["name"];
                        $options->variants_id = $id;
                        $options->save();


                    }
                }

            }
        }
        else
        {
            $image = VariantOptions::where('variants_id', $id)->get();
            foreach ($image as $rs) {
                if ($rs->image != null) {
                    File::delete(public_path($rs->image));
                }
            }
            VariantOptions::where('variants_id', $id)->delete();
        }




        return redirect()->route('admin.variants.list')->with('success','Başarıyla Güncellendi.');



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
}
