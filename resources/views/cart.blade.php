@php
    $setting=\App\Http\Controllers\HomeController::getsettings();
@endphp
@extends('layouts.frontend')
@section('title',$setting->title)
@section('keywords',$setting->keywords)
@section('description',$setting->description)
@section('content')
    <!--section start-->
    <section class="cart-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 table-responsive-xs">
                    <table class="table cart-table">
                        <thead>
                        <tr class="table-head">
                            <th scope="col">Resim</th>
                            <th scope="col">Ürün Adı</th>
                            <th scope="col">Fiyat</th>
                            <th scope="col">Miktar</th>
                            <th scope="col">Toplam</th>
                            <th scope="col">İşlem</th>
                        </tr>
                        </thead>

                        @php
                        $toplam=0;
                        @endphp

                        @foreach($data as $rs)

                            @php $toplam=$toplam+($rs->variantsprice*$rs->quantity);  @endphp

                            <tr>
                                <td><img width="50" src="{{$rs->image}}" alt=""></td>
                                <td>{{$rs->name}}<br>
                                    @isset($rs->variants)
                                        @foreach($rs->variants as $v)
                                            | {{$v->oname}}
                                        @endforeach
                                    @endisset




                                </td>
                                <td>{{ number_format($rs->variantsprice, 2, ',', '.')}} €</td>
                                <td>
                                    <div class="qty-box">
                                        <div class="input-group" style="justify-content:center !important;">
                                            <input type="number" name="quantity" class="form-control input-number" value="{{$rs->quantity}}">
                                        </div>
                                    </div>
                                </td>
                                <td><a href="#" class="icon"><i class="ti-close"></i></a></td>
                                <td>{{number_format(($rs->variantsprice*$rs->quantity), 2, ',', '.')}} €</td>

                            </tr>
                        @endforeach



                    </table>
                    <div class="table-responsive-md">
                        <table class="table cart-table ">
                            <tfoot>
                            <tr>
                                <td>Toplam Fiyat :</td>
                                <td>
                                    <h2>{{number_format($toplam, 2, ',', '.')}} €</h2>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row cart-buttons">
                <div class="col-6"><a href="/" class="btn btn-solid">Alışverişe Devam Et</a></div>
                <div class="col-6"><a href="{{route('checkout')}}" class="btn btn-solid">check out</a></div>
            </div>
        </div>
    </section>
    <!--section end-->
@endsection
