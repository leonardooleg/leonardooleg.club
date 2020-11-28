<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Купить женское нижнее белье в магазине SilkandLace в Москве — Каталог с выгодными ценами на женское белье от магазина "Шелк и Кружево"')</title>
    <!-- Scripts -->


    <!-- Fonts -->

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- ICON NEEDS FONT AWESOME FOR CHEVRON UP ICON -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/favicon.ico">
    <meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">
    {{--иконки--}}
    <script src="https://kit.fontawesome.com/9516ffaf1f.js" crossorigin="anonymous"></script>
    <!-- Custom styles for this template -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css" rel="stylesheet" >
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
    <link href="{{ asset('css/delivery.css') }}" rel="stylesheet">
</head>
<body class="page">
    <div  >




        @yield('content')



        <!-- Return to Top -->
        <a href="javascript:" id="return-to-top"><i class="icon-chevron-up"></i></a>
            <script src="{{ asset('js/app.js') }}" defer></script>
            <script src="https://unpkg.com/vue"></script>
            <script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>

            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="/js/zoomOnHover.js" type="text/javascript"></script>
            @include('layouts.footerCart')

    </div>
</body>



</html>
