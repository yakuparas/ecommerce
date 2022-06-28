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
                        @php $toplam=0 @endphp
                            @foreach($cit as $r)

                        <div class="row product-order-detail">
                            <div class="col-3"><img src="{{$r->image}}" alt="" class="img-fluid blur-up lazyload"></div>
                            <div class="col-3 order_detail">
                                <div>
                                    <h4>Çit</h4>
                                    <h5>{{$r->name}}</h5>
                                    @if(isset($r->variant))
                                        @php $price=0; @endphp
                                        @foreach($r->variant as $v)
                                            {{$v->voname}}
                                            @php $price+=$v->vprice; @endphp

                                        @endforeach
                                    @else
                                        @php $price=$r->price; @endphp
                                    @endif
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
                                    <h5>{{$price}} €</h5>
                                </div>
                            </div>
                            <div class="col-2 order_detail">
                                <div>
                                    <h4>Toplam</h4>
                                    <h5>{{$price*$r->adet}} €</h5>
                                </div>
                            </div>
                        </div>
                                @php $toplam+=$price*$r->adet @endphp
                        @endforeach
                            @foreach($kapi as $r)

                                <div class="row product-order-detail">
                                    <div class="col-3"><img src="{{$r->image}}" alt="" class="img-fluid blur-up lazyload"></div>
                                    <div class="col-3 order_detail">
                                        <div>
                                            <h4>Kapı</h4>
                                            <h5>{{$r->name}}</h5>
                                            @if(isset($r->variant))
                                                @php $price=0; @endphp
                                                @foreach($r->variant as $v)
                                                    {{$v->voname}}
                                                    @php $price+=$v->vprice; @endphp

                                                @endforeach
                                            @else
                                                @php $price=$r->price; @endphp
                                            @endif
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
                                            <h5>{{$price}} €</h5>
                                        </div>
                                    </div>
                                    <div class="col-2 order_detail">
                                        <div>
                                            <h4>Toplam</h4>
                                            <h5>{{$price*$r->adet}} €</h5>
                                        </div>
                                    </div>
                                </div>
                            @php $toplam+=$price*$r->adet @endphp
                            @endforeach
                            @foreach($baba as $r)

                                <div class="row product-order-detail">
                                    <div class="col-3"><img src="{{$r->image}}" alt="" class="img-fluid blur-up lazyload"></div>
                                    <div class="col-3 order_detail">
                                        <div>
                                            <h4>Baba</h4>
                                            <h5>{{$r->name}}</h5>
                                           @if(isset($r->variant))
                                                @php $price=0; @endphp
                                                @foreach($r->variant as $v)
                                                     {{$v->voname}}
                                                    @php $price+=$v->vprice; @endphp

                                                @endforeach
                                            @else
                                                @php $price=$r->price; @endphp
                                            @endif

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
                                            <h5>{{$price}} €</h5>
                                        </div>
                                    </div>
                                    <div class="col-2 order_detail">
                                        <div>
                                            <h4>Toplam</h4>
                                            <h5>{{$price*$r->adet}} €</h5>
                                        </div>
                                    </div>
                                </div>
                            @php $toplam+=$price*$r->adet @endphp
                            @endforeach
                       <br>
                        <br>

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
                            <form action="{{ route('planner.charge') }}" method="post">
                            @auth
                                <div class="col-sm-12">
                                    <h4>Adres Seçiniz</h4>
                                    <select name="adres" id="adres" class="form-control">
                                        @foreach($adres as $rs)
                                            <option value="{{$rs->id}}">{{$rs->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            @endauth

                            <div class="col-md-12">
                                <div class="delivery-sec">
                                    <h3>Total: <span>{{$toplam}} €</span></h3>
                                    <hr>



                                    <input type="hidden"  value="{{$toplam}}" name="amount" />
                                    {{ csrf_field() }}
                                        <input type="submit" class="btn-solid btn" name="submit" value="Pay Now">
                                    </form>
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


