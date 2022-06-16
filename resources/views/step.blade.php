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

                            Çit Uzunluğu
                            <input type="text" name="uzunluk" id="uzunluk">

                            Köşe Sayısı
                            <input type="text" name="kose" id="kose">






                            @if(count($variants)>0)
                                @php $i=0; @endphp
                                @foreach($variants as $rs)
                                    <h6 class="product-title size-text">{{$rs->name}}</h6>
                                    <div id="v-{{$i++}}" class="size-box">
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

                            <h6 class="product-title">Baba</h6>

                            <div class="bundle">
                                <div class="bundle_img">

                                    @foreach($baba as $rs)
                                    <div class="img-box">
                                        <a href="#"><img style="margin-right: 5px !important;" src="{{$rs->image}}" width="100" alt="" class="img-fluid blur-up lazyloaded"></a>
                                        <input type="radio" name="baba" id="baba">{{$rs->name}}
                                    </div>
                                    @endforeach

                                </div>


                            </div>


                            <div class="product-4 product-m">

                                @foreach($kapi as $rs)


                                <div class="product-box">
                                    <div class="img-wrapper">
                                        <div class="front">
                                            <a href="product-page(no-sidebar).html"><img src="{{$rs->image}}" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                        </div>
                                        <div class="back">
                                            <a href="product-page(no-sidebar).html"><img src="{{$rs->image}}" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                        </div>

                                    </div>
                                    <div class="product-detail">

                                        <a href="product-page(no-sidebar).html">
                                            <h6>{{$rs->name}}</h6>
                                        </a>

                                    </div>
                                </div>


                                @endforeach


                            </div>




                                <select class="form-control">
                                    <option value="">ss</option>
                                    <option value="">ss</option>
                                    <option value="">ss</option>
                                    <option value="">ss</option>
                                    <option value="">ss</option>
                                </select>


                            </div>
















                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->
@endsection

@section('js')
    <script>

        $('#v-0 ul li').on('click', function (e) {
            $("#v-0 ul li").removeClass("active");
            $(this).addClass("active");
            $(this).parent().addClass('selected');
        });

        $('#v-1 ul li').on('click', function (e) {
            $("#v-1 ul li").removeClass("active");
            $(this).addClass("active");
            $(this).parent().addClass('selected');
        });
    </script>
@endsection
