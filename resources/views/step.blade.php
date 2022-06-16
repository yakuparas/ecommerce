@php
    $setting=\App\Http\Controllers\HomeController::getsettings();
        $lastmodal=\App\Http\Controllers\HomeController::lastmodal();

@endphp
@extends('layouts.frontend')
@section('title',$setting->title)
@section('keywords',$setting->keywords)
@section('description',$setting->description)
@section('content')

    <!-- section start -->
    <section>
        <div class="collection-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-slick">
                            <div><img src="{{$data->image}}" alt="" id="kapak" class="img-fluid blur-up lazyload image_zoom_cls-0"></div>
                            @foreach($imagelist as $rs)
                                <div><img src="{{$rs->image}}" alt="" class="img-fluid blur-up lazyload image_zoom_cls-0"></div>

                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-12 p-0">
                                <div class="slider-nav">
                                    <div><img src="{{$data->image}}" alt="" id="kapak" class="img-fluid blur-up lazyload image_zoom_cls-0"></div>

                                    @foreach($imagelist as $rs)
                                        <div><img src="{{$rs->image}}" alt="" class="img-fluid blur-up lazyload"></div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 rtl-text">
                        <div class="product-right">

                            <h2>Women Pink Shirt</h2>

                            <div id="selectSize" class="addeffect-section product-description border-product">

                                <h6 class="error-message">please select size</h6>
                                <div class="size-box">
                                    <ul>
                                        <li><a href="javascript:void(0)">s</a></li>
                                        <li><a href="javascript:void(0)">m</a></li>
                                        <li><a href="javascript:void(0)">l</a></li>
                                        <li><a href="javascript:void(0)">xl</a></li>
                                    </ul>
                                </div>

                            </div>
                     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->
@endsection
