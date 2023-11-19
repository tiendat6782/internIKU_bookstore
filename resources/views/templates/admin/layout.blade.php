<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png"> -->
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Bookstore
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link rel="stylesheet" href="{{ asset('assets/css/nucleo-icons.css') }}">
    {{-- <link href="../assets/css/nucleo-icons.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/nucleo-svg.css') }}">
    {{-- <link href="../assets/css/nucleo-svg.css" rel="stylesheet" /> --}}


    {{-- Custom styles --}}

    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">




    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    {{-- <link href="../assets/css/nucleo-svg.css" rel="stylesheet" /> --}}
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}">

    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    <script src="{{ asset('../assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('../assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('../assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('../assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('../assets/js/plugins/chartjs.min.js') }}"></script>
</head>

<body class="g-sidenav-show  bg-gray-100">
    @include('templates.admin.aside')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @yield('content')
    </main>
    <script src="{{ asset('../assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('upload_file/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('upload_file/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('upload_file/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script>
        $(function() {
            function readURL(input, selector) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $(selector).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#image").change(function() {
                readURL(this, '#image_preview');
            });
            $("#logo").change(function() {
                readURL(this, '#image_logo');
            });
        });
    </script>

</body>

</html>
