<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Админка') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"  crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="https://kit.fontawesome.com/70ccfde2bc.js" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('/panel/css/styles.css') }}" rel="stylesheet">


</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="/admin">Админка </a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
    ><!-- Navbar Search-->
    <a class="btn btn-primary" href="/" role="button" target="_blank">На сайт</a>
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
            <div class="input-group-append">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Settings</a><a class="dropdown-item" href="#">Activity Log</a>
                <div class="dropdown-divider"></div>
                <a  class="dropdown-item" href="{{ route('logout') }}"
                   aria-haspopup="true" aria-expanded="false" v-pre onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    {{ __('Выход') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading"></div>
                    <a class="nav-link" href="/admin">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard</a>

                    <div class="sb-sidenav-menu-heading">Маркетплейс</div>
                    <a class="nav-link" href="/admin/orders"><div class="sb-nav-link-icon"><i class="fas fa-cart-plus"></i></div>
                        Заказы</a>
                    <a class="nav-link" href="/admin/shop"><div class="sb-nav-link-icon"><i class="fas fa-money-check-alt" ></i></div>
                        Настройка продаж</a>


                    <div class="sb-sidenav-menu-heading">Основное</div>
                    <a class="nav-link" href="/admin/category"><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Категории</a>
                    <a class="nav-link" href="/admin/category-import"><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Категории импорта</a>

                    <div class="sb-sidenav-menu-heading">Контент</div>
                    <a class="nav-link" href="/admin/products"
                    ><div class="sb-nav-link-icon"><i class="fas fa-bread-slice"></i></div>
                        Товары</a>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-grip-vertical"></i></div>
                        Свойства товаров
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('admin.brands.index')}}">Бренды</a>
                            <a class="nav-link" href="{{route('admin.countries.index')}}">Страны</a>
                            <a class="nav-link" href="{{route('admin.providers.index')}}">Поставщики</a>
                            <a class="nav-link" href="{{route('admin.sizes.index')}}">Размеры</a>
                            <a class="nav-link" href="{{route('admin.colors.index')}}">Цвета</a>
                        </nav>
                    </div>
                    <a class="nav-link" href="/admin/blogs"><div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Блоги
                    </a>
                    <a class="nav-link" href="/admin/pages"><div class="sb-nav-link-icon"><i class="fas fa-scroll"></i></div>
                        Страницы
                    </a>



                    <div class="sb-sidenav-menu-heading">Шаблон</div>
                    <a class="nav-link" href="/admin/menu">
                        <div class="sb-nav-link-icon"><i class="fas fa-braille"></i></div>
                        Меню
                    </a>


                    <div class="sb-sidenav-menu-heading">Управление</div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>
                        Пользователи
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                    <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="{{route('admin.user_managment.user.index')}}">Зарегистрированные</a><a class="nav-link" href="{{route('admin.user_managment.roles.index')}}">Роли</a></nav>
                    </div>



                    <div class="sb-sidenav-menu-heading">Дополнительно</div>
                    <a class="nav-link" href="/" target="_blank"><div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>Перейти на сайт</a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Вы вошли как:</div>
                {{Auth::user()->name ?? 'Нет данных'}}
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>

                <div class="mt-4"></div>
                @yield('content')

        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Leonardooleg 2020</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

<script src="/panel/js/scripts.js"></script>


@if($_SERVER['REQUEST_URI']=='/admin')
    <script src="/panel/assets/demo/chart-bar-demo.js"></script>
    <script src="/panel/assets/demo/datatables-demo.js"></script>
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [@for($b=0;$b<=count($labels)-1;$b++)@if(count($labels)-1==$b)"{{$labels[$b]}}"@else"{{$labels[$b]}}",@endif @endfor],
            datasets: [{
                label: "Продаж",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: [@for($b=0;$b<=count($graf_data)-1;$b++)@if(count($graf_data)-1==$b)"{{$graf_data[$b]}}"@else"{{$graf_data[$b]}}",@endif @endfor],
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: {{count($graf_data)}},
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });

</script>
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Bar Chart Example
    var ctx = document.getElementById("myBarChart");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [@for($b=0;$b<=count($col_month)-1;$b++)@if(count($col_month)-1==$b)"{{$col_month[$b]}}"@else"{{$col_month[$b]}}",@endif @endfor],
            datasets: [{
                label: "Продаж",
                backgroundColor: "rgba(2,117,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: [@for($b=0;$b<=count($col_data)-1;$b++)@if(count($col_data)-1==$b)"{{$col_data[$b]}}"@else"{{$col_data[$b]}}",@endif @endfor],
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'month'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 6
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: {{$col_max}},
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        display: true
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });

</script>
@endif

{!! Menu::scripts() !!}
<!-- include summernote css/js -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script>
    /*редактор текста*/
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200,
            dialogsInBody: true,
            callbacks:{
                onInit:function(){
                    $('body > .note-popover').hide();
                }
            },
        });
    });
    /*редактор текста*/

</script>
</body>

</html>
