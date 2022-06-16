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
    <section class="section-b-space ratio_asos">
        <div class="collection-wrapper">
            <div class="container">
                <div class="row">
                    <div class="collection-content col">
                        <div class="page-main-content">
                            <div class="row">
                                <div class="col-sm-12">

                                    <section class="pt-0 section-b-space ratio_asos">
                                        <div class="container">
                                            <div class="row game-product grid-products">
                                                @foreach($data as $rs)

                                                    <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                                                        <div class="img-wrapper">
                                                            <div class="front">
                                                                <a href="#"><img src="{{$rs->image}}" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                                            </div>

                                                            <a class="add-button" href="{{route('step',['id'=>$rs->id])}}">Yapılandır</a>

                                                        </div>
                                                        <div class="product-detail">
                                                            <a href="#">
                                                                <h6>{{$rs->name}}</h6>
                                                            </a>
                                                        </div>
                                                    </div>


                                                @endforeach

                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section End -->
@endsection
