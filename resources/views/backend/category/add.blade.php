@extends('backend.layouts.admin')
@section('title', 'Kategori Ekleme')
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
                    <a href="{{ route('admin.category.list') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Kategori Ekle</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.category.list') }}">Kategori</a></div>
                    <div class="breadcrumb-item">Kategori Ekle</div>
                </div>
            </div>

            <div class="section-body">


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.category.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori
                                            Adı</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input name="title" type="text" id="title" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alt
                                            Kategori</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select name="parent" class="form-control selectric">
                                                <option value="0">Ana Kategori</option>
                                                @foreach ($catList as $rs )
                                                <option value="{{$rs->id}}">{{\App\Http\Controllers\Backend\CategoryController::getParentsTree($rs,$rs->title)}}</option>   
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Açıklama</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea name="description" class="summernote-simple"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori
                                            Resmi</label>
                                        <div class="col-sm-12 col-md-7">
                                            <div id="image-preview" class="image-preview">
                                                <label for="image-upload" id="image-label">Resim Seç</label>
                                                <input type="file" name="image" id="image-upload" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Anahtar
                                            Kelime</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="keywords" class="form-control inputtags">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Seo URL</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="seourl" id="seourl" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Durum</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select name="status" class="form-control selectric">
                                                <option value="1">Aktif</option>
                                                <option value="0">Pasif</option>
                                            </select>
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
