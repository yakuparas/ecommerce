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

                            <h2>{{$data->name}}</h2>

                            <div id="selectSize" class="addeffect-section product-description border-product">

                            @if(count($variants)>0)
                                @foreach($variants as $rs)
                                        <h6 class="error-message">{{$rs->name}}</h6>
                                        <div class="size-box">
                                            <ul>
                                        @foreach($options as $r)
                                            @if($rs->variant_id==$r->variants_id)
                                                        <li><a href="javascript:void(0)">{{$r->name}}</a></li>
                                            @endif
                                        @endforeach
                                            </ul>
                                        </div>
                                @endforeach
                                <input type="hidden" name="pvariant" id="pvariant">
                            @endif

                            </div>











                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->
@endsection
