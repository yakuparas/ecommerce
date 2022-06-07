@extends('backend.layouts.admin')
@section('title', 'Ürün Ekleme')
@section('css')
    <link rel="stylesheet" href="/backend/assets/modules/dropzonejs/dropzone.css">

@endsection
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.product.list') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Ürün Ekle</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.product.list') }}">Ürün</a></div>
                    <div class="breadcrumb-item">Ürün Ekle</div>
                </div>
            </div>

            <div class="section-body">
                <form method="post" action="{{route('admin.product.store')}}" enctype="multipart/form-data">
                @csrf
                    <div class="row">

                    <div class="col-12 col-md-8 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <div class="col-sm-6">
                                    <label>Ürün Adı</label>
                                    <input type="text" id="name" name="name" class="form-control">
                                        <span class="text-danger">{{ $errors->first('name') }}</span>

                                    </div>
                                    <div class="col-sm-6">
                                    <label>Kategori</label>
                                    <select name="category" class="form-control selectric">
                                        @foreach ($catList as $rs )
                                            <option value="{{$rs->id}}">{{\App\Http\Controllers\Backend\CategoryController::getParentsTree($rs,$rs->title)}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group">

                                </div>

                                <div class="form-group">
                                    <label>Açıklama</label>
                                    <textarea name="description" class="summernote"></textarea>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label>Ürün Resmi</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Üretici</label>
                                        <select name="brand" id="" class="form-control">
                                            @foreach ($brand as $rs )
                                                <option value="{{$rs->id}}">{{$rs->name}}</option>
                                            @endforeach

                                        </select>                                  </div>
                                </div>
                            </div>

                        </div>

                        <div class="card">
                            <div class="card-body">

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label>Seo Url</label>
                                        <input type="text" id="slug" name="slug" class="form-control">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Meta Title</label>
                                        <input type="text" name="meta_title" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label>Meta Description</label>
                                        <input type="text" name="meta_description" class="form-control">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Meta Keyword</label>
                                        <input type="text" name="meta_keyword" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>





                    </div>



                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="card">

                            <div class="card-body">

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label>Ürün Kodu</label>
                                        <input type="text" name="model" class="form-control">
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Barkod</label>
                                        <input type="text" name="sku" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label>Miktar</label>
                                        <input type="number" value="1" name="quantity" class="form-control">                                    </div>
                                    <div class="col-sm-6">
                                        <label>Asgari Satış</label>
                                        <input type="number" value="1" name="mquantity" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label>Alış Fiyatı</label>
                                        <input type="text" name="purchase_price" id="purchase_price" class="form-control">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Etkisi</label>
                                        <select id="price_prefix" onchange="calculate()" name="price_prefix" class="form-control">
                                            <option  value="+">+ Artır</option>
                                            <option value="-">- Azalt</option>
                                            <option selected value="%">% Oran</option>
                                        </select>

                                    </div>
                                    <div class="col-sm-4">
                                        <label>Kar Marjı</label>
                                        <input type="text" name="purchase_discount" id="purchase_discount" onchange="calculate()" class="form-control">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label>Satış Fiyatı</label>
                                        <input type="text" name="price" id="price" class="form-control ">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>İndirimli Satış Fiyatı</label>
                                        <input type="text" name="discount_price" class="form-control">
                                    </div>
                                </div>



                                <div class="form-group row">

                                    <div class="col-sm-6">
                                        <label>Kdv</label>
                                        <select name="tax" id="" class="form-control">
                                            @foreach ($tax as $rs )
                                                <option value="{{$rs->id}}">{{$rs->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="col-sm-6">
                                        <label>Para Birimi</label>
                                        <select name="currency" id="" class="form-control">
                                            @foreach ($currency as $rs )
                                                <option value="{{$rs->id}}">{{$rs->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                </div>
                                <div class="form-group row">

                                    <div class="col-sm-3">
                                        <label>Ağırlık</label>
                                        <input type="text" name="weight" class="form-control">
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Uzunluk</label>
                                        <input type="text" name="length" class="form-control">
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Genişlik</label>
                                        <input type="text" name="width" class="form-control">
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Yükseklik</label>
                                        <input type="text" name="height" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                    <input type="submit" value="Kaydet" class="form-control btn-primary">
                                    </div>
                                </div>


                            </div>

                        </div>

                    </div>

                </div>
                </form>

            </div>
        </section>
    </div>




@endsection
@section('js')
    <script src="/backend/assets/modules/dropzonejs/min/dropzone.min.js"></script>

    <script>
$(document).ready(function(){
  $("#name").change(function(){
   var a=ToSeoUrl($("#name").val());
   $("#slug").val(a);
  });
});

$(".inputtags").tagsinput('items');
        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "Choose File", // Default: Choose File
            label_selected: "Change File", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });


        function calculate()
        {
          let purchase_price= parseFloat($('#purchase_price').val());
          let price_prefix= $('#price_prefix').val();
          let purchase_discount= parseFloat($('#purchase_discount').val());

          let price=0;
          if (purchase_price)
          {

             if (price_prefix=="+")
             {
                price=purchase_price+purchase_discount;
             }
             else if (price_prefix=="-")
             {
                price=purchase_price-purchase_discount;
             }
             else
             {
                price=purchase_price+((purchase_price*purchase_discount)/100)
             }

              document.getElementById('price').value = price;
          }
            else
          {
              document.getElementById('purchase_discount').value = "";

              alert('Lütfen Alış Fiyatını Giriniz');
          }

        }
    </script>

@endsection
