@php
    $setting=\App\Http\Controllers\HomeController::getsettings();
@endphp
@extends('layouts.frontend')
@section('title',$setting->title)
@section('keywords',$setting->keywords)
@section('description',$setting->description)
@section('content')

    <!-- section start -->
    <section class="section-b-space">
        <div class="container">
            <div class="checkout-page">
                <div class="checkout-form">

                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-xs-6">
                                <div class="checkout-title">
                                    <h3>{{__('checkout.Fatura Detayı')}}</h3>
                                </div>
                                <form action="{{ route('paypal.charge') }}" method="post">
                                <div class="row check-out">
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="field-label">Adres Adı</div>
                                        <select name="aname" id="aname">
                                            @foreach($adres as $rs)
                                                <option value="{{$rs->id}}">{{$rs->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-126 col-xs-12">
                                        <div class="field-label">Adres</div>
                                        <input type="text" disabled name="adress" id="adress" value="{{$adres[0]['adress']}}" placeholder="">
                                    </div>

                                    <div class="form-group col-md-12 col-sm-126 col-xs-12">
                                        <div class="field-label">Post Code</div>
                                        <input type="text" disabled name="postcode" id="postcode" value="{{$adres[0]['postcode']}}" placeholder="">
                                    </div>

                                    <div class="form-group col-md-12 col-sm-126 col-xs-12">
                                        <div class="field-label">City</div>
                                        <input type="text" disabled name="city" id="city" value="{{$adres[0]['city']}}" placeholder="">
                                    </div>


                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="field-label">Country</div>
                                        <select disabled name="country" class="form-control" id="country">
                                            @foreach($country as $rs)

                                                <option {{ ($rs->id) == 81 ? 'selected' : '' }} value="{{$rs->id}}">{{$rs->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="field-label">Bölge</div>
                                        <select disabled name="zone" class="form-control" id="zone">
                                            @foreach($zone as $rs)

                                                <option {{ ($rs->id) == 81 ? 'selected' : '' }} value="{{$rs->id}}">{{$rs->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-12 col-xs-12">
                                <div class="checkout-details">
                                    <div class="order-box">
                                        <div class="title-box">
                                            <div>Product <span>Total</span></div>
                                        </div>
                                        @php
                                            $toplam=0;
                                        @endphp
                                        <ul class="qty">
                                            @foreach($data as $rs)

                                                @php $toplam=$toplam+($rs->variantsprice*$rs->quantity);  @endphp
                                            <li>{{$rs->name}}<br>
                                                @isset($rs->variants)
                                                    @foreach($rs->variants as $v)
                                                        | {{$v->oname}}
                                                    @endforeach
                                                @endisset × {{$rs->quantity}} <span>{{ number_format($rs->variantsprice, 2, ',', '.')}} €</span></li>

                                            @endforeach
                                        </ul>

                                        <ul class="total">
                                            <li>Total <span class="count">{{number_format($toplam, 2, ',', '.')}} €</span></li>
                                        </ul>

                                    </div>
                                    <div class="payment-box">
                                        <div class="upper-box">
                                            <div class="payment-options">
                                                <ul>

                                                    <li>
                                                        <div class="radio-option paypal">
                                                            <input type="radio" checked name="payment-group" id="payment-3">
                                                            <label for="payment-3">PayPal<span class="image"><img src="/frontend/assets/images/paypal.png" alt=""></span></label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="text-end">

                                                <input type="hidden"  value="{{number_format($toplam, 2, '.', '');}}" name="amount" />
                                                {{ csrf_field() }}
                                                <input type="submit" class="btn-solid btn" name="submit" value="{{__('checkout.Ödeme Yap')}}">
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </section>
    <!-- section end -->

@endsection

@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#aname').on('change', function() {


            $.ajax({
                type: 'POST',
                url: "{{route('editadress')}}",
                data:{id:this.value},

                success: function(results) {

                    if (results.success === true) {
                        $('#adress').val(results.adress);
                        $('#city').val(results.city);
                        $('#postcode').val(results.postcode)

                        $("#country option[value=" + results.country_id + "]").prop("selected",true);
                        $("#zone option[value=" + results.zone_id + "]").prop("selected",true);


                    }
                }
            });
        });
    </script>
@endsection
