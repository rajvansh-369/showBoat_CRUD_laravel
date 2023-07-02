<!doctype html>
<html lang="en">

<head>
    <title>Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style id="" media="all">

    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('cssAdmin//bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('cssAdmin/style.css') }}">

    <meta name="robots" content="noindex, follow">


</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        @include('adminLayouts.sidebar')
        @yield('content')
    </div>


    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
    {{-- <script src="{{ asset('jsAdmin/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('jsAdmin/popper.js') }}"></script>
    {{-- <script src="{{ asset('jsAdmin/bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('jsAdmin/main.js') }}"></script>

    {{-- <script src="js/main.js"></script> --}}
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v52afc6f149f6479b8c77fa569edb01181681764108816"
        integrity="sha512-jGCTpDpBAYDGNYR5ztKt4BQPGef1P0giN6ZGVUi835kFF88FOmmn8jBQWNgrNd8g/Yu421NdgWhwQoaOPFflDw=="
        data-cf-beacon='{"rayId":"7e05dff57f8e33a2","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2023.4.0","si":100}'
        crossorigin="anonymous"></script>
</body>

</html>
