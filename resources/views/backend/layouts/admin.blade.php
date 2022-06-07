<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- General CSS Files -->
  <link rel="stylesheet" href="/backend/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/backend/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="/backend/assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="/backend/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/backend/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
  <link rel="stylesheet" href="/backend/assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="/backend/assets/modules/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="/backend/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
  <link rel="stylesheet" href="/backend/assets/modules/izitoast/css/iziToast.min.css">
  <link rel="stylesheet" href="/backend/assets/ext-component-sweet-alerts.min.css">
    @yield('css')

  <!-- Template CSS -->
  <link rel="stylesheet" href="/backend/assets/css/style.css">
  <link rel="stylesheet" href="/backend/assets/css/components.css">
    <style>
        #overlay{
            position: fixed;
            top: 0;
            z-index: 100;
            width: 100%;
            height:100%;
            display: none;
            background: rgba(0,0,0,0.6);
        }
        .cv-spinner {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .spinner {
            width: 40px;
            height: 40px;
            border: 4px #ddd solid;
            border-top: 4px #2e93e6 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }
        @keyframes sp-anime {
            100% {
                transform: rotate(360deg);
            }
        }
        .is-hide{
            display:none;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @include('backend.inc._header')
            @include('backend.inc._sidebar')
            @yield('content')
            @include('backend.inc._footer')
        </div>
    </div>
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>
    <!-- General JS Scripts -->
  <script src="/backend/assets/modules/jquery.min.js"></script>
  <script src="/backend/assets/modules/popper.js"></script>
  <script src="/backend/assets/modules/tooltip.js"></script>
  <script src="/backend/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="/backend/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="/backend/assets/modules/moment.min.js"></script>
  <script src="/backend/assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="/backend/assets/modules/datatables/datatables.min.js"></script>
  <script src="/backend/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="/backend/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="/backend/assets/modules/jquery-ui/jquery-ui.min.js"></script>
  <script src="/backend/assets/modules/summernote/summernote-bs4.js"></script>
  <script src="/backend/assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
  <script src="/backend/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
  <script src="/backend/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="/backend/assets/modules/izitoast/js/iziToast.min.js"></script>
  <script src="/backend/assets/sweetalert2.all.min.js"></script>
  <script src="/backend/assets/jquery.repeater.min.js"></script>

  <script>
function ToSeoUrl(textString) {
    textString = textString.replace(/ /g, "-");
    textString = textString.replace(/</g, "");
    textString = textString.replace(/>/g, "");
    textString = textString.replace(/"/g, "");
    textString = textString.replace(/é/g, "");
    textString = textString.replace(/!/g, "");
    textString = textString.replace(/'/, "");
    textString = textString.replace(/£/, "");
    textString = textString.replace(/^/, "");
    textString = textString.replace(/#/, "");
    textString = textString.replace(/$/, "");
    textString = textString.replace(/\+/g, "");
    textString = textString.replace(/%/g, "");
    textString = textString.replace(/½/g, "");
    textString = textString.replace(/&/g, "");
    textString = textString.replace(/\//g, "");
    textString = textString.replace(/{/g, "");
    textString = textString.replace(/\(/g, "");
    textString = textString.replace(/\[/g, "");
    textString = textString.replace(/\)/g, "");
    textString = textString.replace(/]/g, "");
    textString = textString.replace(/=/g, "");
    textString = textString.replace(/}/g, "");
    textString = textString.replace(/\?/g, "");
    textString = textString.replace(/\*/g, "");
    textString = textString.replace(/@/g, "");
    textString = textString.replace(/€/g, "");
    textString = textString.replace(/~/g, "");
    textString = textString.replace(/æ/g, "");
    textString = textString.replace(/ß/g, "");
    textString = textString.replace(/;/g, "");
    textString = textString.replace(/,/g, "");
    textString = textString.replace(/`/g, "");
    textString = textString.replace(/|/g, "");
    textString = textString.replace(/\./g, "");
    textString = textString.replace(/:/g, "");
    textString = textString.replace(/İ/g, "i");
    textString = textString.replace(/I/g, "i");
    textString = textString.replace(/ı/g, "i");
    textString = textString.replace(/ğ/g, "g");
    textString = textString.replace(/Ğ/g, "g");
    textString = textString.replace(/ü/g, "u");
    textString = textString.replace(/Ü/g, "u");
    textString = textString.replace(/ş/g, "s");
    textString = textString.replace(/Ş/g, "s");
    textString = textString.replace(/ö/g, "o");
    textString = textString.replace(/Ö/g, "o");
    textString = textString.replace(/ç/g, "c");
    textString = textString.replace(/Ç/g, "c");
    textString = textString.replace(/--/g, "-");
    textString = textString.replace(/---/g, "-");
    textString = textString.replace(/----/g, "-");
    textString = textString.replace(/----/g, "-");
    return textString.toLowerCase();}


    $('form').on('keypress', function(e) {
    return e.which !== 13;
});
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
  <!-- Page Specific JS File -->
@yield('js')
  <!-- Template JS File -->
  <script src="/backend/assets/js/scripts.js"></script>
  <script src="/backend/assets/js/custom.js"></script>
</body>

</html>
