@extends('backend.layouts.admin')
@section('title', 'Ürün Ekleme')
@section('css')
    <style>
        .gallery-item {
            width: 200px !important;
            height: 200px !important;
        }
    </style>
    <link rel="stylesheet" href="/backend/assets/modules/dropzonejs/dropzone.css">
    <link rel="stylesheet" href="/backend/assets/modules/chocolat/dist/css/chocolat.css">

@endsection
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.product.list') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Resim  Ekle</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.product.list') }}">Kategori</a></div>
                    <div class="breadcrumb-item">Resim Ekle</div>
                </div>
            </div>

            <div class="section-body">

                    <div class="row">

                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">


                                <form id="dropzoneForm" class="dropzone" action="{{ route('dropzone.upload') }}">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{$id}}">
                                </form>
                                <div class="card-footer">

                                <button type="button" class="btn btn-info" id="submit-all">Resimleri Yükle</button>
                                </div>

                            </div>

                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="card">

                                    <div class="card-body">
                                        <div class="gallery gallery-md" id="uploaded_image">
                                            <div class="gallery-item" data-image="/backend/assets/img/news/img03.jpg" data-title="Image 1" href="/backend/assets/img/news/img03.jpg" title="Image 1" style="background-image: url(&quot;/backend/assets/img/news/img03.jpg&quot;);"></div>

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
@section('js')
    <script src="/backend/assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

    <script src="/backend/assets/modules/dropzonejs/min/dropzone.min.js"></script>


    <script>
        Dropzone.options.dropzoneForm = {
            autoProcessQueue : false,
            acceptedFiles : ".png,.jpg,.gif,.bmp,.jpeg",
            parallelUploads: 10,
            dictDefaultMessage: "Resimleri Seçin veya Sürükleyin.<br>Aynı anda 10  adet resim yükleyebilirsiniz.",

            init:function(){
                var submitButton = document.querySelector("#submit-all");
                myDropzone = this;

                submitButton.addEventListener('click', function(){
                    myDropzone.processQueue();
                });

                this.on("complete", function(){
                    if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
                    {
                        var _this = this;
                        _this.removeAllFiles();
                    }
                    load_images();
                });

            }

        };

        load_images();

        function load_images()
        {
            var id = $("#id").val();
            var url = "{{ route('dropzone.fetch', ":id") }}";
            url = url.replace(':id', id);
            console.log(url);

            $.ajax({
                url:url,
                success:function(data)
                {
                    $('#uploaded_image').html(data);
                }
            })
        }

      function  deletex(xid)
        {

            $.ajax({
                url:"{{ route('dropzone.delete') }}",
                data:{id : xid},
                success:function(data){
                    load_images();
                }
            })
        }



    </script>
@endsection
