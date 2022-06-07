@extends('backend.layouts.admin')
@section('title', 'Ürün Ekleme')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.product.list') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Seçenek Ekle</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.product.list') }}">Ürün Listesi</a></div>
                    <div class="breadcrumb-item">Seçenek Ekle</div>
                </div>
            </div>

            <div class="section-body">

                <div class="card">
                    <form action="{{route('admin.product.addvariants')}}" method="post">
                        @csrf
                        <input type="hidden" name="pid" value="{{$id}}">


                    <div class="card-header">
                        <h4>Seçenek Ekle</h4>
                    </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab2" role="tablist">

                                @foreach($data as $key=>$rs)
                                    <li class="nav-item">
                                        <a class="nav-link @if ($key === 0) active @endif"  onclick="load_options({{$rs->id}});" id="tab-2" data-toggle="tab" href="#t{{$key}}" role="tab"  aria-selected="false">{{$rs->name}}</a>
                                    </li>
                                @endforeach


                            </ul>
                            <div class="tab-content tab-bordered" id="myTab3Content">


                                @for ($i = 0; $i < $count; $i++)
                                    <div class="tab-pane fade show @if ($i === 0) active @endif" id="t{{$i}}" role="tabpanel">

                                        <div class="repeater">
                                            <div data-repeater-list="{{$i}}">
                                                <div data-repeater-item>
                                                    <div class="row d-flex align-items-end">

                                                        <div class="col-md-2 col-12">
                                                            <div class="form-group">
                                                                <label for="variant-stock">Seçenek Değeri</label>

                                                                    <select class="form-control" name="options" id="voptions">
                                                                        @foreach($vo as $rs)
                                                                            <option value="{{$rs->id}}">{{$rs->name}}</option>
                                                                        @endforeach
                                                                    </select>


                                                            </div>
                                                        </div>

                                                        <div class="col-md-2 col-12">
                                                            <div class="form-group">
                                                                <label for="variant-stock">Miktar</label>
                                                                <input type="number" id="quantity" value="1" name="quantity" class="form-control" />
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2 col-12">
                                                            <div class="form-group">
                                                                <label for="variant-stock">Fiyat</label>
                                                                <input type="text" id="price" value="0" name="price" class="form-control" />
                                                                <input type="hidden" id="vid" name="vid" value="{{$data[$i]['id']}}" class="form-control" />
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2 col-12">
                                                            <div class="form-group">
                                                                <label for="variant-stock">Para Birimi</label>
                                                                <select name="currency" id="" class="form-control">
                                                                    @foreach ($currency as $rs )
                                                                        <option value="{{$rs->id}}">{{$rs->name}}</option>
                                                                    @endforeach

                                                                </select>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-2 col-12">
                                                            <div class="form-group">
                                                                <label for="variant-stock">Fiyata Etkisi</label>

                                                                <select id="price_prefix" name="price_prefix" class="form-control">
                                                                    <option value="+">+ Artır</option>
                                                                    <option value="-">- Azalt</option>
                                                                    <option value="=">= Eşitle</option>
                                                                </select>
                                                            </div>
                                                        </div>



                                                        <div class="col-md-2 col-12">
                                                            <div class="form-group">
                                                                <button class="btn btn-outline-danger text-nowrap px-1 del" data-repeater-delete type="button">
                                                                    <i data-feather="x" class="mr-25"></i>
                                                                    <span>Sil</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                                        <i data-feather="plus" class="mr-25"></i>
                                                        <span>Yeni Ekle</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                @endfor







                            </div>
                        </div>

                    <div class="card-footer">
                        <div class="col-12 col-md-2 col-lg-2">
                        <input type="submit" value="Kaydet" class="form-control btn-outline-primary">
                    </div>
                    </div>
                    </form>
                </div>

                <div class="card">

                    <div class="card-header">
                        <h4>Seçenek Listesi</h4>
                    </div>

                    <div class="card-body">
                           <div class="table-responsive">
                               <table class="table table-striped">
                                   <tbody>
                                   <tr>
                                       <th>Seçenek Adı</th>
                                       <th>Seçenek Değeri</th>
                                       <th>Miktar</th>
                                       <th>Fiyat</th>
                                       <th>Fiyat Etkisi</th>
                                       <th>Para Birimi</th>
                                       <th>İşlemler</th>
                                   </tr>
                                   @foreach($vlist as $rs)

                                       <tr>
                                           <td>{{$rs->vname}}</td>
                                           <td>{{$rs->name}}</td>
                                           <td>{{$rs->quantity}}</td>
                                           <td><input type="text" onchange="pricechange({{$rs->id}})" name="pricex" value="{{$rs->price}}" data-id="{{$rs->id}}" id="p{{$rs->id}}"></td>
                                           <td>
                                               <select id="price_prefix{{$rs->id}}" onchange="pricechange({{$rs->id}})" name="price_prefix" class="form-control">
                                                   <option @if($rs->price_prefix=='+')
                                                               selected
                                                       @endif value="+">+ Artır</option>
                                                   <option @if($rs->price_prefix=='-')
                                                               selected
                                                           @endif value="-">- Azalt</option>
                                                   <option @if($rs->price_prefix=='=')
                                                               selected
                                                           @endif value="=">= Eşitle</option>
                                               </select>

                                           </td>
                                           <td>{{$rs->csymbol}}</td>
                                           <td>     <a href="#" onclick="deleteConfirmation({{ $rs->id }})"
                                                       data-id="{{ $rs->id }}"

                                                       class="btn btn-icon btn-sm btn-secondary delete-confirm"><i
                                                       class="fa fa-trash" aria-hidden="true"></i>
                                               </a></td>
                                       </tr>



                                   @endforeach



                                   </tbody>
                               </table>
                           </div>
                    </div>

                </div>
            </div>
        </section>
    </div>




@endsection
@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function  pricechange(pid)
        {
             let newprice=$('#p'+pid).val();
             let id=pid;
             let url = "{{ route('variants.priceupdate', ":id") }}";
            url = url.replace(':id', id);
            $.ajax({
                type: 'POST',
                url: url,
                data:{id:id,price:newprice},
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $("#overlay").fadeIn(300);
                },

                success: function(results) {
                    console.log(results);
                    if (results.success === true) {


                    } else {

                    }
                },
                complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                    $("#overlay").fadeOut(300);
                }
            });

        }

        function  prefixchange(pid)
        {
            console.log("ssas");
            let newprefix=$('#price_prefix'+pid).val();
            console.log("dsd",newprefix,pid);
            let id=pid;
            let url = "{{ route('variants.prefixupdate', ":id") }}";
            url = url.replace(':id', id);
            $.ajax({
                type: 'POST',
                url: url,
                data:{id:id,prefix:newprefix},
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $("#overlay").fadeIn(300);
                },

                success: function(results) {
                    console.log(results);
                    if (results.success === true) {


                    } else {

                    }
                },
                complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                    $("#overlay").fadeOut(300);
                }
            });

        }
        function load_options(xid)
        {


            var id = xid;
            var url = "{{ route('variants.fetch', ":id") }}";
            url = url.replace(':id', id);
            console.log(url);

            var a=xid-1;


            $.ajax({
                url:url,
                success:function(data)
                {
                    //$('#fm-'+xid).html(data);
                    //$('#t'+a).html(data);$
                   // $('#a'+a).html(data);

                }
            })
        }


        $('.repeater').repeater({
            show: function () {
                $(this).slideDown();
                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                }
            }
        });


        function deleteConfirmation(id) {
            Swal.fire({
                title: 'Eminmisin?',
                text: "Bunu İşlemi Geri Alamazsınız!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Evet, Sil!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ml-1'
                },
                buttonsStyling: false
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "{{ url('/admin/product_variant/delete') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results.success === true) {
                                swal.fire("Başarılı!", results.message, "success");
                                // refresh page after 2 seconds
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            } else {
                                swal.fire("Hata!", results.message, "error");
                            }
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }
    </script>


@endsection
