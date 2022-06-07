@extends('backend.layouts.admin')
@section('title', 'Slider Ekleme')
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
                    <a href="{{ route('admin.slider.list') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Slide Ekle</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.slider.list') }}">Slide Listesi</a></div>
                    <div class="breadcrumb-item">Slide Ekle</div>
                </div>
            </div>

            <div class="section-body">


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.slider.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Resim</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input required name="image" type="file" id="title" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Url</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input name="url" type="text" id="title" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Açıklama</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea name="description" class="summernote">

                                                <div>
                                        <h4>Küçük Başlık</h4>
                                        <h1>Başlık</h1>
                                        <a href="#" class="btn btn-solid" tabindex="0">Devam</a>
                                    </div>

                                            </textarea>

                                        </div>
                                    </div>


                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <input class="btn btn-primary" type="submit" value="Kaydet">
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
$(document).ready(function(){
  $("#title").change(function(){
   var a=ToSeoUrl($("#title").val());
   $("#seourl").val(a);
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
