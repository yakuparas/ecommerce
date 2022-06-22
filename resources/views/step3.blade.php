@php
    $setting=\App\Http\Controllers\HomeController::getsettings();
        $lastmodal=\App\Http\Controllers\HomeController::lastmodal();

@endphp
@extends('layouts.frontend')
@section('title',$setting->title)
@section('keywords',$setting->keywords)
@section('description',$setting->description)
@section('content')

    <!-- order-detail section start -->
    <section class="section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-order">
                        @foreach($cit as $r)

                        <div class="row product-order-detail">
                            <div class="col-3"><img src="{{$r->image}}" alt="" class="img-fluid blur-up lazyload"></div>
                            <div class="col-3 order_detail">
                                <div>
                                    <h4>Ürün Adı</h4>
                                    <h5>{{$r->name}}</h5>
                                </div>
                            </div>
                            <div class="col-3 order_detail">
                                <div>
                                    <h4>Adet</h4>
                                    <h5>{{$r->adet}}</h5>
                                </div>
                            </div>
                            <div class="col-3 order_detail">
                                <div>
                                    <h4>Fiyat</h4>
                                    <h5>{{$r->price}}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                            @foreach($kapi as $r)

                                <div class="row product-order-detail">
                                    <div class="col-3"><img src="{{$r->image}}" alt="" class="img-fluid blur-up lazyload"></div>
                                    <div class="col-3 order_detail">
                                        <div>
                                            <h4>Ürün Adı</h4>
                                            <h5>{{$r->name}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-3 order_detail">
                                        <div>
                                            <h4>Adet</h4>
                                            <h5>{{$r->adet}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-3 order_detail">
                                        <div>
                                            <h4>Fiyat</h4>
                                            <h5>{{$r->price}}</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @foreach($baba as $r)

                                <div class="row product-order-detail">
                                    <div class="col-3"><img src="{{$r->image}}" alt="" class="img-fluid blur-up lazyload"></div>
                                    <div class="col-3 order_detail">
                                        <div>
                                            <h4>Ürün Adı</h4>
                                            <h5>{{$r->name}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-3 order_detail">
                                        <div>
                                            <h4>Adet</h4>
                                            <h5>{{$r->adet}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-3 order_detail">
                                        <div>
                                            <h4>Fiyat</h4>
                                            <h5>{{$r->price}}</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        <div class="total-sec">
                            <ul>
                                <li>subtotal <span>$55.00</span></li>
                                <li>shipping <span>$12.00</span></li>
                                <li>tax(GST) <span>$10.00</span></li>
                            </ul>
                        </div>
                        <div class="final-total">
                            <h3>total <span>$77.00</span></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="order-success-sec">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Sipariş Notu</h4>
                                <ul class="order-detail">
                                    {!! $comments !!}
                                </ul>
                            </div>

                            <div class="col-sm-12 payment-mode">
                                <h4>payment method</h4>
                                <p>Pay on Delivery (Cash/Card). Cash on delivery (COD) available. Card/Net banking
                                    acceptance subject to device availability.</p>
                            </div>
                            <div class="col-md-12">
                                <div class="delivery-sec">
                                    <h3>expected date of delivery: <span>october 22, 2018</span></h3>
                                    <a href="order-tracking.html">track order</a>
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
        let kapiid;
        let kapioptionid;
        let kapigenisligi;
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
                    kapiid= $('#koptions option:selected').data('pid');
                    kapioptionid= $('#koptions option:selected').data('pvid');
                    kapigenisligi=parseInt( $('#koptions option:selected').data('voname'));

                    console.log(kapiid,kapioptionid,kapigenisligi);


                }
            })
        }




        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });




        $(document).on('change','#koptions',function(){

            kapiid=$(':selected', this).data('pid');
            kapioptionid=$(':selected', this).data('pvid');
            kapigenisligi=parseInt($(':selected', this).data('voname'));


        });






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
            let kapiadet=$("input[name=kapiadet]").val();
            let kose=$("input[name=kose]").val();
            let pid=$("input[name=pid]").val();
            let babaid=$("input[name=baba]:checked").data('babaid');

            console.log(pid,pvid,uzunluk,kose,babaid,kapiid,kapioptionid,kapigenisligi);


            $.ajax({
                type: 'POST',
                url: "{{route('step2')}}",
                data:{
                    pid:pid,
                    pvid:pvid,
                    uzunluk:uzunluk,
                    kose:kose,
                    babaid:babaid,
                    kapiid:kapiid,
                    kapioptionid:kapioptionid,
                    kapigenisligi:kapigenisligi,
                    kapiadet:kapiadet,

                },


                success: function(results) {

                    if (results.success === true) {
                        window.location.href = "/zaunplanner/step-3";


                    }

                }
            });



        }











    </script>
@endsection
