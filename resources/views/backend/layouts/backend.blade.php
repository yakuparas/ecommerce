<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('title')</title>
    <link rel="stylesheet" href="/backend/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/backend/assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/backend/assets/modules/izitoast/css/iziToast.min.css">
    <link rel="stylesheet" href="/backend/assets/ext-component-sweet-alerts.min">

  <link rel="stylesheet" href="/backend/assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="/backend/assets/modules/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="/backend/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="/backend/assets/modules/dropzonejs/dropzone.css">

    @yield('css')
    <link rel="stylesheet" href="/backend/assets/css/style.css">
    <link rel="stylesheet" href="/backend/assets/css/components.css">
</head>
<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            @include('backend.inc._header')
            @include('backend.inc._sidebar')
            @yield('content')
            @include('backend.inc._footer')
        </div>
    </div>
    <script src="/backend/assets/modules/jquery.min.js"></script>
    <script src="/backend/assets/modules/popper.js"></script>
    <script src="/backend/assets/modules/tooltip.js"></script>
    <script src="/backend/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="/backend/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="/backend/assets/modules/moment.min.js"></script>
    <script src="/backend/assets/js/stisla.js"></script>
    <script src="/backend/assets/modules/izitoast/js/iziToast.min.js"></script>
    <script>
      @if(Session::has('info'))
          iziToast.info({
          title: 'Hello, world!',
          message: 'This awesome plugin is made iziToast toastr',
          position: 'topRight'
      });
      @endif

          @if(Session::has('error'))
          iziToast.error({
      title: 'Hata!',
      message: '{{session('error')}}',
      position: 'topRight'
    });
          @endif



          @if(Session::has('warning'))
          iziToast.warning({
      title: 'Hello, world!',
      message: 'This awesome plugin is made by iziToast',
      position: 'topRight'
    });
          @endif

          @if(Session::has('success'))
         iziToast.success({
      title: 'Başarılı!',
      message: '{{session('success')}}',
      position: 'topRight'
    });
          @endif
        </script>
    <script src="/backend/assets/sweetalert2.all.min.js"></script>
    <script src="/backend/assets/modules/summernote/summernote-bs4.js"></script>
    <script src="/backend/assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
    <script src="/backend/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
    <script src="/backend/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

    @yield('js')

    <script src="/backend/assets/js/scripts.js"></script>
    <script src="/backend/assets/js/custom.js"></script>
</body>
</html>
