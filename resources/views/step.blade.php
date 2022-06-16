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
    <section class="section-b-space">
        <div class="collection-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-sm-12">
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="filter-main-btn mb-2"><span class="filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> Sidebar</span></div>
                                </div>
                            </div>
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
                                        <input type="hidden" name="price" id="price" value="{{$data->price}}">
                                        <h3 class="price-detail">{{$data->price}}

                                            @if($data->discount_price != null)
                                                <del>{{$data->discount_price}}</del>
                                            @endif<span>55% off</span></h3>
                                        <hr>
                                        @if(count($variants)>0)
                                            @foreach($variants as $rs)
                                                <select  name="{{$rs->name}}" class="theme_checkbox variants"  id="{{$rs->name}}">
                                                    @foreach($options as $r)
                                                        @if($rs->variant_id==$r->variants_id)
                                                            <option data-id="{{$r->pvid}}"
                                                                    data-price="{{$r->price}}"
                                                                    data-prefix="{{$r->price_prefix}}"
                                                                    data-image="{{$r->image}}"
                                                                    value="{{$r->pvid}}">{{$r->name}}</option>
                                                        @endif

                                                    @endforeach
                                                </select>
                                            @endforeach
                                            <input type="hidden" name="pvariant" id="pvariant">
                                        @endif

                                        <h6 class="product-title">Miktar</h6>
                                        <div class="qty-box">
                                            <div class="input-group">

                                                <input type="number" name="quantity" max="{{$data->quantity}}" class="form-control input-number" value="1">

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="product-buttons">
                                            <input type="hidden" name="pid" id="pid" value="{{$data->id}}">
                                            <span   id="cartEffect" onclick="addcart('  {{$data->id}}  ')" data-bs-toggle="modal" data-bs-target="#addtocart" class="btn btn-solid hover-solid btn-animation">
                                                <i class="fa fa-shopping-cart me-1" aria-hidden="true"></i> add to
                                                cart</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <section class="tab-product m-0">
                            <div class="row">
                                <div class="col-sm-12 col-lg-12">
                                    <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-selected="true"><i class="icofont icofont-ui-home"></i>Açıklama</a>
                                            <div class="material-border"></div>
                                        </li>

                                    </ul>
                                    <div class="tab-content nav-material" id="top-tabContent">
                                        <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                                            <div class="product-tab-discription">
                                                <div class="part">
                                                    {!! $data->description !!}
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->
@endsection
