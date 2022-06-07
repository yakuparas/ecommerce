<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\settings;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class SettingsController extends Controller
{

    public function  index()
    {
        $data=settings::first();

        if ($data===null)
        {
            $data=new settings();
            $data->title="Grows E-ticaret Projesi";
            $data->save();
            $data=settings::first();
        }

       return view('backend.settings.index',['data'=>$data]);

    }

    public function update(Request $request,$id)
    {

        if($request->hasFile('logo'))
        {

            $validatedData = $request->validate([
                'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1024',
            ],
            );

            $imageName = time().'.'.$request->logo->extension();
            $request->logo->move(public_path('images'), $imageName);
            $pathlogo="/images/".$imageName;

        }
        else
        {
            $pathlogo="/upload/logo.png";

        }


        if($request->hasFile('favicon'))
        {
            $validatedData = $request->validate([
                'favicon' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1024',
            ],
            );

            $imageName = time().'.'.$request->favicon->extension();
            $request->favicon->move(public_path('images'), $imageName);
            $pathfav="/images/".$imageName;

        }
        else
        {
            $pathfav="/upload/favicon.png";

        }

        $set=settings::find($id);
        $set->logo=$pathlogo;
        $set->favicon=$pathfav;
        $set->title=$request->title;
        $set->keywords=$request->keywords;
        $set->description=$request->description;
        $set->company=$request->company;
        $set->phone=$request->phone;
        $set->mobile=$request->mobile;
        $set->fax=$request->fax;
        $set->email=$request->email;
        $set->facebook=$request->facebook;
        $set->instagram=$request->instagram;
        $set->twitter=$request->twitter;
        $set->youtube=$request->youtube;
        $set->linkedin=$request->linkedin;
        $set->analytics=$request->analytics;
        $set->smtpserver=$request->smtpserver;
        $set->smtpemail=$request->smtpemail;
        $set->smtppassword=$request->smtppassword;
        $set->smtpport=$request->smtpport;
        $set->save();


        $data=settings::first();
        return view('backend.settings.index',['data'=>$data]);

    }
}
