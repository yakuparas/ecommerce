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
<hr>
                            Köşe Sayısı
                            <input type="text" name="kose" id="kose">

<hr>




                            @if(count($variants)>0)
                                @php $i=0; @endphp
                                @foreach($variants as $rs)
                                    <h6 class="product-title size-text">{{$rs->name}}</h6>
                                    <div id="v-{{$i++}}" class="size-box">
                                        <ul id="variants-{{$i}}">
                                        @foreach($options as $r)
                                            @if($rs->variant_id==$r->variants_id)
                                                    <li data-pvid="{{$r->pvid}}" data-price="{{$r->price}}" data-prefix="{{$r->price_prefix}}"><a>{{$r->name}}</a></li>
                                            @endif

                                        @endforeach
                                        </ul>
                                    </div>

                                @endforeach
                                <input type="hidden" name="pvariant" id="pvariant">
                            @endif
<hr>
                            <h6 class="product-title">Baba</h6>

                            <div class="bundle">
                                <div class="bundle_img">

                                    @foreach($baba as $rs)
                                    <div class="img-box">
                                        <a href="#"><img style="margin-right: 5px !important;" src="{{$rs->image}}" width="100" alt="" class="img-fluid blur-up lazyloaded"></a>
                                        <input type="radio" data-babaname="{{$rs->name}}" data-babaid="{{$rs->id}}" data-babaprice="{{$rs->price}}" name="baba" id="baba">{{$rs->name}}
                                    </div>
                                    @endforeach

                                </div>


                            </div>
<hr>
                            <h6 class="product-title">Kapı Seçiniz</h6>

                            <div class="product-4 product-m">

                                @foreach($kapi as $rs)
                                    {{$rs->image}}

                                <div class="product-box">
                                    <div class="img-wrapper">
                                        <div class="front">
                                            <img src="{{$rs->image}}" class="img-fluid blur-up lazyload" alt=""></a>
                                        </div>


                                    </div>
                                    <div class="product-detail">

                                        <a href="#">
                                            <h6>{{$rs->name}}</h6>
                                            <input onclick="getir({{$rs->id}})" type="radio" name="kapi" id="kapi">
                                        </a>

                                    </div>
                                </div>


                                @endforeach


                            </div>




                            <div class="bundle" id="kapiyukseklik">


                            </div>


                            <div class="product-buttons">
                                <input type="hidden" name="pid" id="pid" value="{{$data->id}}">

                                <span   id="cartEffect" onclick="addcart('{{$data->id}}')"  class="btn btn-solid hover-solid btn-animation">
                                                <i class="fa fa-shopping-cart me-1" aria-hidden="true"></i> Next</span>
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
        let vlist=[];
        let a,b;

        $('#v-0 ul li').on('click', function (e) {
            $("#v-0 ul li").removeClass("active");
            $(this).addClass("active");
            $(this).parent().addClass('selected');
            a=$(this).data('pvid');


        });

        $('#v-1 ul li').on('click', function (e) {
            $("#v-1 ul li").removeClass("active");
            $(this).addClass("active");
            $(this).parent().addClass('selected');
            b=$(this).data('pvid');

        });

        function getir(id)
        {
            var id = id;
            var url = "{{ route('zauplanner.variants.fetch', ":id") }}";
            url = url.replace(':id', id);
            $.ajax({
                url:url,
                success:function(data)
                {

                    $('#kapiyukseklik').html(data);


                }
            })
        }



        function addcart(x)
        {
            let vlist=[];
            vlist.indexOf(a) === -1 ? vlist.push(a) : console.log("Bu Öğe Daha Önce Eklenmiş..");
            vlist.indexOf(b) === -1 ? vlist.push(b) : console.log("Bu Öğe Daha Önce Eklenmiş..");

            $( "#pvariant" ).val(vlist);
            let pvid;
            if($("input[name=pvariant]").val())
            {
                pvid=$("input[name=pvariant]").val();
            }
            else
            {
                pvid=null;
            }
            let uzunluk=$("input[name=uzunluk]").val();
            let kose=$("input[name=kose]").val();
            let pid=$("input[name=pid]").val();
            let babaid=$("input[name=baba]:checked").data('babaid');
            let kapiid=$("input[name=koptions]:selected").data('kpid');
            let kapioptionid=$("input[name=koptions]:selected").data('kpvid');

            console.log(pid,pvid,uzunluk,kose,babaid,kapiid,kapioptionid);


        }











    </script>
@endsection
