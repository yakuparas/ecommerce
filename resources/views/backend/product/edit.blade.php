@extends('backend.layouts.admin')
@section('title', 'Ürün Güncelleme')
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
                <h1>Ürün Güncelleme</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.product.list') }}">Ürünler</a></div>
                    <div class="breadcrumb-item">Ürün Güncelle</div>
                </div>
            </div>

            <div class="section-body">
                <form method="post" action="{{ route('admin.product.update', [ 'id'=> $data->id ]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-8 col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <div class="col-sm-6">
                                            <label>Ürün Adı</label>
                                            <input type="text" id="name" name="name" value="{{$data->name}}" class="form-control">
                                            <span class="text-danger">{{ $errors->first('name') }}</span>

                                        </div>
                                        <div class="col-sm-6">
                                            <label>Kategori</label>
                                            <select name="category" class="form-control selectric">
                                                @foreach ($catList as $rs )
                                                    <option @if($rs->id == $data->category_id) selected @endif value="{{$rs->id}}">{{\App\Http\Controllers\Backend\CategoryController::getParentsTree($rs,$rs->title)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                    </div>

                                    <div class="form-group">
                                        <label>Açıklama  {{$data->name}}</label>
                                        <textarea name="description" class="summernote">{{$data->description}}</textarea>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div id="image-preview" class="image-preview" style="background-image:url("{{$data->image}}")")>
                                                <label for="image-upload" id="image-label">Resim Seç</label>
                                                <input type="file"  name="image" id="image-upload" />
                                            </div>

                                        </div>
                                        <div class="col-sm-6">
                                            <label>Üretici</label>
                                            <select name="brand" id="" class="form-control">
                                                @foreach ($brand as $rs )
                                                    <option @if($rs->id == $data->brand_id) selected @endif value="{{$rs->id}}">{{$rs->name}}</option>
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
                                            <input type="text" value="{{$data->slug}}" id="slug" name="slug" class="form-control">
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Meta Title</label>
                                            <input type="text" value="{{$data->meta_title}}" name="meta_title" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label>Meta Description</label>
                                            <input type="text" value="{{$data->meta_description}}" name="meta_description" class="form-control">
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Meta Keyword</label>
                                            <input type="text" value="{{$data->meta_keyword}}" name="meta_keyword" class="form-control">
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
                                            <input type="text" value="{{$data->model}}" name="model" class="form-control">
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Barkod</label>
                                            <input type="text" value="{{$data->sku}}" name="sku" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label>Miktar</label>
                                            <input type="number" value="{{$data->quantity}}"  name="quantity" class="form-control">                                    </div>
                                        <div class="col-sm-6">
                                            <label>Asgari Satış</label>
                                            <input type="number" value="1" name="mquantity" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label>Satış Fiyatı</label>
                                            <input type="text" value="{{$data->price}}" name="price" class="form-control ">                                    </div>
                                        <div class="col-sm-6">
                                            <label>İndirimli Satış Fiyatı</label>
                                            <input type="text" value="{{$data->discount_price}}" name="discount_price" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label>Alış Fiyatı</label>
                                            <input type="text" value="{{$data->purchase_price}}" name="purchase_price" class="form-control">                                    </div>
                                        <div class="col-sm-6">
                                            <label>Kdv</label>
                                            <select name="tax" id="" class="form-control">
                                                @foreach ($tax as $rs )
                                                    <option @if($rs->id == $data->tax_id) selected @endif  value="{{$rs->id}}">{{$rs->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <div class="col-sm-6">
                                            <label>Ağırlık</label>
                                            <input type="text" value="{{$data->weight}}" name="weight" class="form-control">
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Para Birimi</label>
                                            <select name="currency" id="" class="form-control">
                                                @foreach ($currency as $rs )
                                                    <option @if($rs->id == $data->currency_id) selected @endif value="{{$rs->id}}">{{$rs->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label>Uzunluk</label>
                                            <input type="text" value="{{$data->length}}" name="length" class="form-control">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Genişlik</label>
                                            <input type="text" name="width" value="{{$data->width}}" class="form-control">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Yükseklik</label>
                                            <input type="text" name="height" value="{{$data->height}}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="submit" value="Güncelle" class="form-control btn-primary">
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
    </script>
@endsection
