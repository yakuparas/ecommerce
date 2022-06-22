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
                <div class="col-lg-8">
                    <div class="product-order">
                        @foreach($cit as $r)

                        <div class="row product-order-detail">
                            <div class="col-3"><img src="{{$r->image}}" alt="" class="img-fluid blur-up lazyload"></div>
                            <div class="col-3 order_detail">
                                <div>
                                    <h4>Çit</h4>
                                    <h5>{{$r->name}}</h5>
                                </div>
                            </div>
                            <div class="col-2 order_detail">
                                <div>
                                    <h4>Adet</h4>
                                    <h5>{{$r->adet}}</h5>
                                </div>
                            </div>
                            <div class="col-2 order_detail">
                                <div>
                                    <h4>Birim Fiyat</h4>
                                    <h5>{{$r->price}}</h5>
                                </div>
                            </div>
                            <div class="col-2 order_detail">
                                <div>
                                    <h4>Toplam</h4>
                                    <h5>{{$r->price*$r->adet}}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                            @foreach($kapi as $r)

                                <div class="row product-order-detail">
                                    <div class="col-3"><img src="{{$r->image}}" alt="" class="img-fluid blur-up lazyload"></div>
                                    <div class="col-3 order_detail">
                                        <div>
                                            <h4>Kapı</h4>
                                            <h5>{{$r->name}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-2 order_detail">
                                        <div>
                                            <h4>Adet</h4>
                                            <h5>{{$r->adet}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-2 order_detail">
                                        <div>
                                            <h4>Birim Fiyat</h4>
                                            <h5>{{$r->price}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-2 order_detail">
                                        <div>
                                            <h4>Toplam</h4>
                                            <h5>{{$r->price*$r->adet}}</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @foreach($baba as $r)

                                <div class="row product-order-detail">
                                    <div class="col-3"><img src="{{$r->image}}" alt="" class="img-fluid blur-up lazyload"></div>
                                    <div class="col-3 order_detail">
                                        <div>
                                            <h4>Baba</h4>
                                            <h5>{{$r->name}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-2 order_detail">
                                        <div>
                                            <h4>Adet</h4>
                                            <h5>{{$r->adet}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-2 order_detail">
                                        <div>
                                            <h4>Birim Fiyat</h4>
                                            <h5>{{$r->price}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-2 order_detail">
                                        <div>
                                            <h4>Toplam Fiyat</h4>
                                            <h5>{{$r->price*$r->adet}}</h5>
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
                <div class="col-lg-4">
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


