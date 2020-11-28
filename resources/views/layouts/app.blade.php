<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="yandex-verification" content="1635ea30f9d3a3c8" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Купить женское нижнее белье в магазине SilkandLace в Москве — Каталог с выгодными ценами на женское белье от магазина "Шелк и Кружево"')</title>
    <!-- Scripts -->


    <!-- Fonts -->

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Scripts -->

    <!-- Custom styles for this template -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" rel="stylesheet" >
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" >


    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/zoomOnHover.css') }}" rel="stylesheet">
    @if(preg_match('!cart!', $_SERVER['REQUEST_URI']))  <link href="{{ asset('css/delivery.css') }}" rel="stylesheet">  @endif

    @if(preg_match('!profile!', $_SERVER['REQUEST_URI']))  <link href="{{ asset('css/profile.css') }}" rel="stylesheet">    @endif
</head>
<body  class="page">
<div id="app">
    <div class="mt-2">
    {{--<div id="cart">--}}
    <div >
        @if(isset($nenujno))
            <!--пока не нужно-->
       {{-- <div class="container-fluid info" onclick="window.location='/actions/besplatnaya-dostavka-po-vsey-rossii.html/';">
            <div class="container container-my">
                <i class="icon icon--delivery info__icon"></i>
                <span class="info__text"><b>Бесплатная доставка</b> по всей России</span>
                <a class="link link--inherit info__link" href="/actions/besplatnaya-dostavka-po-vsey-rossii.html/">Подробнее</a>
            </div>
        </div>--}}
        @endif
        <div  class="container container-my">
            <nav class="navbar navbar-expand-lg navbar-light d-none d-md-block">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto h_menu">
                        @foreach(Menu::getByName('Шапка') as $menu_h)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $menu_h['link'] }}" title="">{{ $menu_h['label'] }}</a>
                            </li>
                        @endforeach


                    </ul>
                    <form class="form-inline my-2 my-lg-0 ">
                        <input class="form-control mr-sm-2 bg-dark" type="search" placeholder="Найти" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0 bg-dark" type="submit">Поиск</button>
                    </form>
                </div>
            </nav>
            <div class="row ">
                <div class="col-lg-4 col-md-6 order-xs-2 order-sm-2 order-md-2 order-lg-1 order-2 d-none d-md-block">
                    <div class="header__contacts">
                        <div class="tel">
                            ﻿<a class="link link--text" href="tel:+78001008766">+7 (800) 100-87-66</a><div class="number__desc">Бесплатно по всей России</div><br>
                            <a class="link link--text" href="tel:+74951338608">+7 (495) 133-86-08</a><div class="number__desc">Для Москвы</div>
                            <a class="tg_link" href="tg://resolve?domain=silkandlacebot" target="_blank"><span class="tg_span"><img src="/img/telegram.png" class="loading" data-was-processed="true">@<span>silkandlacebot</span></span></a>
                        </div>
                        <div class="header__working">
                            Работаем круглосуточно, заявки обрабатываем пн-пт
                        </div>
                    </div>
                </div>

                <div class="order-1 order-sm-1 order-md-1 order-lg-2 order-xl-2 col-lg-4 col-md-12 col-sm-12 justify-content-md-center text-center">
                    <a class="logo header__logo " href="/">
                        <img class="img logo__img loading" src="/img/logo.png" alt="SilkandLace" srcset="/img/logo@2x.png 2x" data-was-processed="true">                        <div class="logo__slogan">Нижнее белье и одежда для дома</div>
                    </a>
                </div>

                <div class="order-3 col-lg-4 col-md-6 order-sm-3 order-md-3">
                    <div class="header__sign text-right">
                        <ul class="header__sign__items">
                            @if (Route::has('login'))
                                @auth
                                    <a href="/profile"><i class="fa fa-user"></i> Профиль {{Auth::user()->name ?? 'пользователя'}} </a>
                                    <a   href="{{ route('logout') }}"  aria-haspopup="true" aria-expanded="false" v-pre onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('   ( Выход )') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @else

                                    <li class="header__sign__item">
                                        <a href="/login" class="link link--text" >Войти</a>
                                    </li>
                                    <li class="header__sign__item">
                                        <a href="/register" class="link link--text" >Зарегистрироваться</a>
                                    </li>

                                @endauth
                            @endif
                                <div id="search_mob" class="ml-4" onclick="search_line()">
                                    <svg   width="1.4em" height="1.4em" viewBox="0 0 16 16" class="bi bi-search ml-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                    </svg> <p class="ml-1">Поиск</p>
                                </div>
                        </ul>

                        <form class="form-inline my-2 my-lg-0  search-line" style="display: none">
                            <input class="form-control mr-sm-2 bg-dark" type="search" placeholder="Найти" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0 bg-dark" type="submit">Поиск</button>
                        </form>
                    </div>
                        <div  class="header__cart float-right d-none d-md-block">
                            <a class="link link--text" href="/cart/">
                                <i class="icon icon--cart link__icon"></i><span>Корзина @{{itemCount}}</span>
                            </a>
                            <ul class="list header__cart-info dn">
                                <li class="list__item"><b class="ajb_count">0</b><span>@{{itemCount}} товар(ов)</span></li>
                                <li class="list__item"><b class="ajb_sum">0</b><span> руб.</span></li>
                            </ul>
                        </div>

                </div>
            </div>
        </div>
        <div class="container-fluid   pt-2 ">
            <!--Меню для моб-->
            <ul class="nav mob-nav fixed-bottom menu_mobile">
                <li class="nav-item text-center">
                    <a class="nav-link active" href="/new">
                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-file-spreadsheet-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M12 1H4a2 2 0 0 0-2 2v2h12V3a2 2 0 0 0-2-2zm2 5h-4v2h4V6zm0 3h-4v2h4V9zm0 3h-4v3h2a2 2 0 0 0 2-2v-1zm-5 3v-3H6v3h3zm-4 0v-3H2v1a2 2 0 0 0 2 2h1zm-3-4h3V9H2v2zm0-3h3V6H2v2zm4 0V6h3v2H6zm0 1h3v2H6V9z"/>
                    </svg>
                   Новинки</a>
                </li>
                <li class="nav-item text-center">
                    <a class="nav-link"  data-toggle="modal" data-target="#BackdropMenu"  >
                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-files" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 2h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3z"/>
                        <path d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2z"/>
                    </svg>
                    Каталог</a>
                </li>
                <li class="nav-item text-center">
                    <a class="nav-link" href="/cart"> <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-basket2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M1.111 7.186A.5.5 0 0 1 1.5 7h13a.5.5 0 0 1 .489.605l-1.5 7A.5.5 0 0 1 13 15H3a.5.5 0 0 1-.489-.395l-1.5-7a.5.5 0 0 1 .1-.42zM2.118 8l1.286 6h9.192l1.286-6H2.118z"/>
                        <path fill-rule="evenodd" d="M11.314 1.036a.5.5 0 0 1 .65.278l2 5a.5.5 0 1 1-.928.372l-2-5a.5.5 0 0 1 .278-.65zm-6.628 0a.5.5 0 0 0-.65.278l-2 5a.5.5 0 1 0 .928.372l2-5a.5.5 0 0 0-.278-.65z"/>
                        <path d="M4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zM0 6.5A.5.5 0 0 1 .5 6h15a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1z"/>
                    </svg>
                    Корзина <span class="cart_count"> @{{itemCount}}</span></a>
                </li>
                <li class="nav-item text-center">
                    <a class="nav-link" href="/contacts">
                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-telephone-inbound-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2.267.98a1.636 1.636 0 0 1 2.448.152l1.681 2.162c.309.396.418.913.296 1.4l-.513 2.053a.636.636 0 0 0 .167.604L8.65 9.654a.636.636 0 0 0 .604.167l2.052-.513a1.636 1.636 0 0 1 1.401.296l2.162 1.681c.777.604.849 1.753.153 2.448l-.97.97c-.693.693-1.73.998-2.697.658a17.471 17.471 0 0 1-6.571-4.144A17.47 17.47 0 0 1 .639 4.646c-.34-.967-.035-2.004.658-2.698l.97-.969zM15.854.146a.5.5 0 0 1 0 .708L11.707 5H14.5a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 1 0v2.793L15.146.146a.5.5 0 0 1 .708 0z"/>
                    </svg>
                   Позвонить </a>
                </li>

            </ul>
            <!--Меню для моб-->
            <nav  class="navbar navbar-expand-sm navbar-dark bg-dark d-none d-md-flex">
                <div class="container container-my">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu1" aria-controls="menu1" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div id="menu1" class="collapse navbar-collapse" >
                        <ul class="navbar-nav mr-auto menu__items">
                            @foreach(Menu::getByName('Главное') as $menu)
                                <li class="nav-item menu__item @if( $menu['child'] ) dropdown @endif">
                                    <a href="{{ $menu['link'] }}" class="nav-link @if( $menu['child'] )dropdown-toggle @endif"  @if( $menu['child'] )data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @endif>{{ $menu['label'] }}</a>
                                    @if( $menu['child'] )
                                        <ul class="dropdown-menu menu__content" aria-labelledby="navbarDropdownMenuLink">
                                                    @foreach( $menu['child'] as $child )
                                                        <li class="menu__sub-item">
                                                            <a href="{{ $child['link'] }}" class="text-left dropdown-item menu__sub-link">{{ $child['label'] }}</a>
                                                        </li>
                                                    @endforeach

                                        </ul><!-- /.sub-menu -->
                                    @endif
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>







        @yield('content')


        <!-- Footer -->
        <footer class="footer">
            <div class="container container-footer">
                <div class="row ">

                    <div class="col-md-4 order-1 order-sm-1 order-md-1 text-center text-md-left">
                        <div class="row">
                            <div class="col-md-6 list__item">
                                <div class="list__head">
                                    <p><a class="link link--text" href="/pokupka/">Покупателям</a></p>
                                </div>
                                <p><a class="link link--text" href="/delivery/">Доставка и оплата</a></p>
                                <p><a class="link link--text" href="/kakzakazat/">Как сделать заказ</a></p>
                                <p><a class="link link--text" href="/kak-poluchit-promokod/">Как получить промокод</a></p>
                                <p><a class="link link--text" href="/programma-loyalnosti/">Программа лояльности</a></p>
                                <p><a class="link link--text" href="/primerka/">Примерка</a></p>
                                <p><a class="link link--text" href="/return">Возврат и обмен товара</a></p>
                                <p><a class="link link--text" href="/blog">Блог</a></p>
                                <p><a class="link link--text" href="/brands">Бренды</a></p>
                                <p><a class="link link--text" href="/sales">Распродажа </a></p>
                            </div>
                            <div class="col-md-6 ">




                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 order-3  order-sm-3 order-md-2  text-center">
                        <div class="logo footer__logo">
                            <img class="img logo__img loading" src="/img/logo_footer.png" alt="SilkandLace"  data-was-processed="true">                    <div class="logo__slogan">Нижнее белье и одежда для дома</div>
                        </div>
                        <div class="footer__copyright">
                            <b>SilkandLace.ru</b>  ИНН: 665204863619<br> ОГРН: 319665800239370                </div>
                    </div>


                    <div class="col-md-4 order-2  order-sm-2 order-md-3  text-center text-md-right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="list__head">
                                    <p><a class="link link--text" href="/about/">О Компании</a></p>
                                </div>
                                <p><a class="link link--text" href="/about/">О нас</a></p>
                                <p><a class="link link--text" href="/contacts/">Контакты</a></p>
                                <p><a class="link link--text" href="/news/">Новости</a></p>
                                <p><a class="link link--text" href="/search/map/">Карта сайта</a></p>
                                <p><a class="link link--text" href="https://yandex.ru/maps/-/CBqhqRu93D" target="_blank">Отзывы о нас</a></p>
                                <p><a class="link link--text" href="/wholesale/">Оптовым покупателям</a></p>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <p><a class="link  list__head link--text" href="/contacts/">Контакты</a></p>

                                    <p><a class="link link--text" href="tel:+78001008766">+7 (800) 100-87-66</a></p>
                                    <p><a class="link link--text" href="mailto:info@silkandlace.ru">info@silkandlace.ru</a></p>
                                    <div class="social social--light">







                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

    {{--Мобильное модальное меню--}}
    <div class="mod_menu">
        <!-- Modal -->
        <div class="modal fade" id="BackdropMenu" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="BackdropMenuLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 class="modal-title text-center mb-4 mt-2" >Категории</h3>

                        @php
                            if (isset($b_menu)){
                                $n=0;
                                $count=count($b_menu);
                                $menu_1='<div class="form-group menu_Mob menu_1"> <select class="form-control form-control-lg" >';
                                        foreach($b_menu as $menu_b){
                                            $n++;
                                            $menu_1.='<option class="menu_1_opt_'.$n.'"';
                                            if(strpos($_SERVER['REQUEST_URI'], $menu_b['path']) !== false)  {
                                                $menu_1.='selected ';}
                                             $menu_1.='link="';
                                            if(!isset($menu_b['menu'])){
                                                $menu_1.='/catalog/';}
                                             $menu_1.= $menu_b['path'] .'" >'. $menu_b['title'].'</option>';
                                            if ($n==$count){
                                                $menu_1.='</select> </div>';
                                            }

                                            if(isset($menu_b['children'])){
                                                    $n2=0;
                                                    foreach($menu_b['children'] as $menu_c){
                                                        if($n2==0){
                                                            $count2=count($menu_b['children']);
                                                            $menu_2[$n]='<div class="form-group menu_Mob menu_2"> <select class="form-control form-control-lg  menu_1_opt_'.$n.'" > <option link="/catalog/'.$menu_b['path'].'">Все товары</option>';
                                                        }
                                                            $n2++;
                                                            $menu_2[$n].='<option class="menu_2_sub_'.$n.'_opt_'.$n2.'"';
                                                             if(strpos($_SERVER['REQUEST_URI'], $menu_c['path']) !== false) {
                                                                $menu_2[$n].=' selected ';}
                                                             $menu_2[$n].= 'link="';
                                                            if(!isset($menu_b['menu'])){
                                                                $menu_2[$n].='/catalog/';
                                                                 $menu_2[$n].= $menu_c['path'] .'" >'. $menu_c['title'] .'</option>';
                                                            }
                                                            if ($n2==$count2){
                                                             $menu_2[$n].='</select> </div>';
                                                           }
                                                            if($menu_c['children']){
                                                                        $n3=0;
                                                                        foreach($menu_c['children'] as $menu_c_c){
                                                                            if($n3==0){
                                                                                 $count3=count($menu_c['children']);
                                                                                 $menu_3[$n2]='<div class="form-group  menu_Mob menu_3"> <select class="form-control form-control-lg  menu_2_sub_'.$n.'_opt_'.$n2.'" > <option link="/catalog/'.$menu_c['path'].'">Все товары</option>';
                                                                            }
                                                                            $n3++;
                                                                            $menu_3[$n2].='<option class="menu_3_opt_'.$n3.'"';
                                                                             if(strpos($_SERVER['REQUEST_URI'], $menu_c_c['path']) !== false){
                                                                                 $menu_3[$n2].=' selected ';  }
                                                                                 $menu_3[$n2].='  link="';

                                                                                 if(!isset($menu_b['menu'])){
                                                                                     $menu_3[$n2].='/catalog/';
                                                                                      $menu_3[$n2].= $menu_c_c['path'] .'" >'. $menu_c_c['title'].'</option>';
                                                                                 }
                                                                            }
                                                                            if ($n3==$count3){
                                                                                $menu_3[$n2].='</select> </div>';
                                                                            }
                                                            }
                                                    }
                                            }
                                        }
                                echo $menu_1;

                                foreach ($menu_2 as $item) {
                                     echo $item;
                                }
                                foreach ($menu_3 as $item) {
                                     echo $item;
                                }

                            }
                        @endphp

                        <button type="button" class="btn btn-primary  btn-lg btn-block   menu_go">Применить</button>

                    </div>
                </div>
            </div>
        </div>

    {{--Мобильное модальное меню--}}


    <!-- Return to Top -->
    <a href="javascript:" id="return-to-top"><i class="icon-chevron-up"></i></a>
    <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://unpkg.com/vue"></script>

        <script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
    <script src="https://unpkg.com/vue-infinite-loading@^2/dist/vue-infinite-loading.js"></script>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="/js/site.js" type="text/javascript"></script>
    <script src="/js/zoomOnHover.js" type="text/javascript"></script>




   {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" type="text/javascript"></script>--}}
    {{--<script src="/js/carousel.js" type="text/javascript"></script>--}}





    @include('layouts.footerCart')
    </div>
</body>



</html>
