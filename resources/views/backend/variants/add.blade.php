@extends('backend.layouts.admin')
@section('title', 'Kategori Ekleme')
@section('css')

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="/backend/assets/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="/backend/assets/modules/codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="/backend/assets/modules/codemirror/theme/duotone-dark.css">
    <link rel="stylesheet" href="/backend/assets/modules/jquery-selectric/selectric.css">
    <style>
        .image-preview {
            width: 100px !important;
            height: 100px !important;
        }

    </style>
@endsection
@section('content')
    
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.variants.list') }}" class="btn btn-icon"><i
                            class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Seçenek Ekle</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.variants.list') }}">Varyant</a></div>
                    <div class="breadcrumb-item">Seçenek Ekle</div>
                </div>
            </div>

            <div class="section-body">


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <form method="POST" action="{{ route('admin.variants.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Seçenek
                                            Adı</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input name="title" type="text" id="title" class="form-control">
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="repeater">
                                        <div data-repeater-list="variant">
                                            <div data-repeater-item>
                                                <div class="row d-flex align-items-end">

                                                    <div class="col-md-2 col-12">
                                                        <div class="form-group">
                                                            <label for="variant-stock">Seçenek Değer Adı</label>
                                                            <input type="text" id="itemname" name="name"
                                                                class="form-control" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2 col-12">
                                                        <div class="form-group">
                                                            <label for="variant-price">Seçenek Değeri Resmi</label>

                                                                <input type="file" onchange="showPreview(event);" name="img" id="image-upload" />

                                                        </div>
                                                    </div>

                                                    <div class="col-md-2 col-12">
                                                        <div class="form-group">
                                                            <div class="preview">

                                                                <img width="100px" name="file-ip-1-preview" id="file-ip-1-preview">
                                                              </div>                                                        </div>
                                                    </div>



                                                    <div class="col-md-2 col-12">
                                                        <div class="form-group">
                                                            <button
                                                                class="btn btn-outline-danger text-nowrap px-1 del"
                                                                data-repeater-delete type="button">
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
                                                <button class="btn btn-icon btn-primary" type="button"
                                                    data-repeater-create>
                                                    <i data-feather="plus" class="mr-25"></i>
                                                    <span>Yeni Ekle</span>
                                                </button>
                                            </div>
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
function showPreview(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("file-ip-1-preview");
    preview.src = src;
    preview.style.display = "block";
  }
}
            $('.repeater').repeater({
            show: function () {
                $(this).slideDown();
                // Feather Icons
                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                }
            }
        });
    </script>
@endsection
