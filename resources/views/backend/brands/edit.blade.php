@extends('backend.layouts.admin')
@section('title', 'Kategori Güncelleme')
@section('css')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="/backend/assets/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="/backend/assets/modules/codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="/backend/assets/modules/codemirror/theme/duotone-dark.css">
    <link rel="stylesheet" href="/backend/assets/modules/jquery-selectric/selectric.css">
@endsection
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.brands.list') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Kategori Güncelleme</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.brands.list') }}">Kategori Listesi</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.brands.create') }}">Kategori Ekle</a></div>
                </div>
            </div>

            <div class="section-body">


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <form method="POST" action="{{route('admin.brands.update',$data["id"])}}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori
                                            Adı</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input name="name" type="text" value="{{$data->name}}" id="title" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori
                                            Resmi</label>
                                        <div class="col-sm-12 col-md-7">
                                            <div id="image-preview" class="image-preview">
                                                <label for="image-upload" id="image-label">Resim Seç</label>
                                                <input type="file" name="image" id="image-upload" />
                                                <img src="{{$data->image}}" alt="" width="100">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <input class="btn btn-primary" type="submit" value="Güncelle">
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>




@endsection
@section('js')
    <script>


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
