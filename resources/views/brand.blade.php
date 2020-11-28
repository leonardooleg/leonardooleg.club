@extends('layouts.app')

@section('title', $brand_one->name_brand)

@section('content')
    <div class="container container-my">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="/" class="link breadcrumbs__link">Главная</a> </li>
                <li class="breadcrumb-item"><a href="/brands" class="link breadcrumbs__link">Бренды</a></li>
                <li class="breadcrumb-item"><a class="link breadcrumbs__link">{{$brand_one->name_brand}}</a></li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-2">
                <div class="catalog d-none d-md-block">
                    <div class="title catalog__title">
                        <a href="/catalog/" class="cat_h">
                            Каталог
                        </a>
                    </div>
                    <ul class="catalog__items">
                        @foreach($b_menu as $menu_b)
                            <li class="catalog__item ">
                                <a class="link link--text @if(strpos($_SERVER['REQUEST_URI'], $menu_b['path']) !== false) catalog__sub-item--active @endif "   href="@if(!isset($menu_b['menu']))/catalog/@endif{{ $menu_b['path'] }}" title="">{{ $menu_b['title'] }}</a>
                                <span class="catalog__num">6027</span>
                                @if(isset($menu_b['children']))
                                    <ul class="catalog__sub-items">
                                        @foreach($menu_b['children'] as $menu_c)
                                            <li class="catalog__sub-item ">
                                                <a class="link link--text @if(strpos($_SERVER['REQUEST_URI'], $menu_c['path']) !== false) catalog__sub-item--active @endif "  href="@if(!isset($menu_b['menu']))/catalog/@endif{{ $menu_c['path'] }}" title="">{{ $menu_c['title'] }}</a>
                                                <span class="catalog__num">787</span>
                                                @if($menu_c['children'])
                                                    <ul class="catalog__sub-items">
                                                        @foreach($menu_c['children'] as $menu_c_c)
                                                            <li class="catalog__sub-item ">
                                                                <a class="link link--text @if(strpos($_SERVER['REQUEST_URI'], $menu_c_c['path']) !== false) catalog__sub-item--active @endif " href="@if(!isset($menu_b['menu']))/catalog/@endif{{ $menu_c_c['path'] }}" title="">{{ $menu_c_c['title'] }}</a>
                                                                <span class="catalog__num">1</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <div class="col-md-10">

                <h1 class="title title--size-m title--light text-center">{{$brand_one->name_brand}}</h1>

                <div class="title title--size-s title--dim title--light text-center title--underline content__sub-title">{{$count}} товаров</div>

                <form name="_form" action="/catalog" method="get" class="filter form smartfilter">
                    <div class="filter__items">

                        <div class="dropdown filter__item">
                            <button class="btn " type="button" id="dropdownBrand" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="filter__open" >Бренд</div>
                            </button>
                            <div class="dropdown-menu filter__box" aria-labelledby="dropdownBrand">
                                @foreach ($filters['brand'] as $id=>$brand)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="filter_brand[]" value="{{$id}}" id="CheckBrand{{$id}}" @if($brand== $brand_one->name_brand) checked @endif >
                                        <label class="form-check-label" for="CheckBrand{{$id}}">
                                            {{$brand}}
                                        </label>
                                    </div>
                                @endforeach
                                <div class="filter__buttons filter__buttons_js" style="display: flex;">
                                    <button  type="submit"  class="btn btn-outline-dark filter__button filter__apply"> Применить </button >
                                    <a  class="btn btn-outline-dark filter__button filter__cancel"> Очистить </a>

                                </div>
                            </div>
                        </div>

                        <div class="dropdown filter__item">
                            <button class="btn " type="button" id="dropdownCountry" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="filter__open" >Страна</div>
                            </button>
                            <div class="dropdown-menu filter__box" aria-labelledby="dropdownCountry">
                                @foreach ($filters['country'] as $id=>$country)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="filter_country[]" value="{{$id}}" id="CheckCountry{{$id}}" @if(isset( $_GET['filter_country'])) @if(in_array($id, $_GET['filter_country'])) checked @endif @endif>
                                        <label class="form-check-label" for="CheckCountry{{$id}}">
                                            {{$country}}
                                        </label>
                                    </div>
                                @endforeach
                                <div class="filter__buttons filter__buttons_js" style="display: flex;">
                                    <button  type="submit"  class="btn btn-outline-dark filter__button filter__apply"> Применить </button >
                                    <a  class="btn btn-outline-dark filter__button filter__cancel"> Очистить </a>

                                </div>
                            </div>
                        </div>

                        <div class="dropdown filter__item">
                            <button class="btn " type="button" id="dropdownSize" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="filter__open" >Размер</div>
                            </button>
                            <div class="dropdown-menu filter__box" aria-labelledby="dropdownSize">
                                @foreach ($filters['size'] as $id=>$size)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="filter_size[]" value="{{$id}}" id="CheckSize{{$id}}" @if(isset( $_GET['filter_size'])) @if(in_array($id, $_GET['filter_size'])) checked @endif @endif>
                                        <label class="form-check-label" for="CheckSize{{$id}}">
                                            {{$size}}
                                        </label>
                                    </div>
                                @endforeach
                                <div class="filter__buttons filter__buttons_js" style="display: flex;">
                                    <button  type="submit"  class="btn btn-outline-dark filter__button filter__apply"> Применить </button >
                                    <a  class="btn btn-outline-dark filter__button filter__cancel"> Очистить </a>

                                </div>
                            </div>
                        </div>

                        <div class="dropdown filter__item">
                            <button class="btn " type="button" id="dropdownColor" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="filter__open" >Цвет</div>
                            </button>
                            <div class="dropdown-menu filter__box" aria-labelledby="dropdownColor">
                                @foreach ($filters['color'] as $id=>$color_one)
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" name="filter_color[]" value="{{$color_one}}" id="CheckColor{{$id}}" @if(isset( $_GET['filter_color'])) @if(in_array($color_one, $_GET['filter_color'])) checked @endif @endif>
                                        <label class="form-check-label" for="CheckColor{{$id}}">
                                            <img src="{{$color_one}}" width="15px" height="15px" class="mr-1">{{ $id}}
                                        </label>
                                    </div>
                                @endforeach
                                <div class="filter__buttons filter__buttons_js" style="display: flex;">
                                    <button  type="submit"  class="btn btn-outline-dark filter__button filter__apply"> Применить </button >
                                    <a  class="btn btn-outline-dark filter__button filter__cancel"> Очистить </a>

                                </div>
                            </div>
                        </div>



                        <div class="dropdown filter__item">
                            <button class="btn " type="button" id="dropdownSort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="filter__open" >Сортировать по</div>
                            </button>
                            <div class="dropdown-menu filter__box" aria-labelledby="dropdownSort">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sort" id="exampleRadios1" value="price" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Цене
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sort" id="exampleRadios2" value="new">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Новизне
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sort" id="exampleRadios3" value="discount">
                                    <label class="form-check-label" for="exampleRadios3">
                                        Скидке
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sort" id="exampleRadios4" value="popular">
                                    <label class="form-check-label" for="exampleRadios4">
                                        Популярности
                                    </label>
                                </div>
                                <div class="filter__buttons filter__buttons_js" style="display: flex;">
                                    <button  type="submit"  class="btn btn-outline-dark filter__button filter__apply"> Применить </button >


                                </div>
                            </div>
                        </div>

                    </div>
                </form>



                <div id="goods_all" >

                    <div class="row content__cards content__gap">

                        @foreach ($products as $product)
                            <div class="col-sm-3">
                                <div class="card card--hover" >
                                    <div class="card-body">
                                        <div class="" >
                                            <a href="javascript:void(0)" class="wish_item" data-id="2291907"></a>
                                            @if($product->sale==1)<div class="discounts">SALE</div>@endif
                                            <a class="link card__image" href="/catalog/{{$product->path}}/{{$product->slug}}.html">
                                                <img class="img lazy loaded" alt=""  src="@foreach(explode(';', $product->media) as $media){{$media}}@break @endforeach" data-was-processed="true">
                                            </a>
                                            <div class="card__description">
                                                <a class="detail_c_desc" href="/catalog/{{$product->path}}/{{$product->slug}}.html">
                                                    <div class="card__name">{{$product->name}}</div>
                                                </a>

                                                <div class="card__type">{{$product->title}}</div>


                                                <div class="card__price">
                                                    <s>0 руб.</s><i>{{$product->price}} руб.</i>
                                                </div>
                                                <div class="card__action card__hover">
                                                    <a href="/catalog/{{$product->path}}/{{$product->slug}}.html" class="button button--default button--bright card__button">
                                                        <span class="button__text">Перейти</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach



            </div>
                    <div class="blog-pagination style2 text-center">
                        <ul class="pagination pull-right">
                            {{$products->links()}}
                        </ul><!-- /.flat-pagination -->
                    </div><!-- /.blog-pagination -->
                </div>
                @if($count<5)
                <h6 class="text-center mb-5">Товаров бренда "{{$brand_one->name_brand}}" не найдено</h6>
                <h4 class="font-weight-light mt-5">Товары других брендов </h4>
                <div class="row content__cards content__gap">

                    @foreach ($related_products as $product)
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="card card--hover" >
                                <div class="card-body">
                                    <div class="" >
                                        <a href="javascript:void(0)" class="wish_item" data-id="2291907"></a>
                                        @if($product->sale==1)<div class="discounts">SALE</div>@endif
                                        <a class="link card__image" href="/catalog/{{$product->path}}/{{$product->slug}}.html">
                                            <img class="img lazy loaded" alt=""  src="@foreach(explode(';', $product->media) as $media){{$media}}@break @endforeach" data-was-processed="true">
                                        </a>
                                        <div class="card__description">
                                            <a class="detail_c_desc" href="/catalog/{{$product->path}}/{{$product->slug}}.html">
                                                <div class="card__name">{{$product->name}}</div>
                                            </a>

                                            <div class="card__type">{{$product->title}}</div>


                                            <div class="card__price">
                                                <s>0 руб.</s><i>{{$product->price}} руб.</i>
                                            </div>
                                            <div class="card__action card__hover">
                                                <a href="/catalog/{{$product->path}}/{{$product->slug}}.html" class="button button--default button--bright card__button">
                                                    <span class="button__text">Перейти</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach



                </div>
                @endif


                <blockquote class="short">
                    {{--Страна: Франция.--}}
                </blockquote>
                <table class="table-img" width="100" cellpadding="5" align="left">
                    <tbody>
                    <tr>
                        <td>
                            <img width="100"  src="/storage/{{$brand_one->logo_brand}}" height="100" title="Нижнее белье Coquette Revue" hspace="5" vspace="5" align="middle" class="loading" data-was-processed="true">
                        </td>
                    </tr>
                    </tbody>
                </table>
                <p>
                    {{$brand_one->description_brand}}
                </p>

                <blockquote class="short">
                    <a href="/sizes/{{$brand_one->url}}.html" style="text-decoration: underline;">Посмотреть размерную сетку белья</a>.
                </blockquote>






            </div>
        </div>


    </div>



@endsection
