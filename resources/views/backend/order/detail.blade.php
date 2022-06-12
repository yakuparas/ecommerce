@extends('backend.layouts.admin')
@section('title', 'Order Details')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Invoice</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
                    <div class="breadcrumb-item">Order Details</div>
                </div>
            </div>

            <div class="section-body">
                <div class="invoice">
                    <div class="invoice-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="invoice-title">
                                    <h2>Invoice</h2>
                                    <div class="invoice-number">Order #{{$order[0]->id}}</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>Adress To:</strong><br>
                                            {{$order[0]->uname}}<br>
                                            {{$order[0]->email}}<br>
                                            {{$order[0]->adress}}<br>
                                            {{$order[0]->postcode}}<br>
                                            {{$order[0]->country}}<br>
                                            {{$order[0]->zone}}<br>
                                        </address>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>Payment Method:</strong><br>
                                            Payment ID :{{$order[0]->payment_id}}<br>
                                            Payment Status :{{$order[0]->payment_status}}<br>

                                        </address>
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <address>
                                            <strong>Order Date:</strong><br>
                                            {{$order[0]->created_at}}<br><br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="section-title">Order Summary</div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-md">
                                        <tr>
                                            <th data-width="40">#ProductID</th>
                                            <th>Product</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-right">Totals</th>
                                        </tr>
                                        @php
                                        $toplam=0;
                                        @endphp
                                        @foreach($data as $rs)
                                        <tr>
                                            <td>{{$rs->id}}</td>
                                            <td>{{$rs->product_name}}</td>
                                            <td>{{$rs->quantity}}</td>
                                            <td>{{$rs->price}}</td>
                                            <td>{{$rs->price*$rs->quantity}}</td>
                                        </tr>
                                            @php
                                            $toplam+=$rs->price*$rs->quantity;
                                            @endphp
                                        @endforeach

                                    </table>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-8">
                                        <div class="section-title">Note</div>
                                        <p class="section-lead">{{$order[0]->comment}}</p>

                                    </div>
                                    <div class="col-lg-4 text-right">

                                        <hr class="mt-2 mb-2">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Total</div>
                                            <div class="invoice-detail-value invoice-detail-value-lg">{{$toplam}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>


@endsection
