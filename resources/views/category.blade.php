@extends('layouts.app')

@section('title', $title ?? 'Каталог')



@section('content')
    <div class="container container-my">

        @isset($categories)
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="/" class="link breadcrumbs__link">Главная</a> </li>
                @foreach($categories as $i => $category)
                    <li class="breadcrumb-item">{{ $category->ancestors->count() ? implode('  ', $category->ancestors->pluck('tile')->toArray()):''  }}
                    <a href="/catalog/{{ $category->path }}" class="link breadcrumbs__link">{{ $category->title }}</a></li>
                @endforeach
            </ol>
        </nav>
        @endif

        <div class="row">
            <div class="col-md-2">

                <div class="catalog d-none d-md-block">
                    <div class="title catalog__title">
                        <a href="/catalog/" class="cat_h">
                            Каталог
                        </a>
                    </div>
                    <ul class="catalog__items" >
                        @foreach($b_menu as $menu_b)
                            <li class="catalog__item ">
                                <a class="link link--text @if(strpos($_SERVER['REQUEST_URI'], $menu_b['path']) !== false) catalog__sub-item--active @endif "   href="@if(!isset($menu_b['menu']))/catalog/@endif{{ $menu_b['path'] }}" title="">{{ $menu_b['title'] }}</a>
                              {{--  <span class="catalog__num">6027</span>--}}
                                @if(isset($menu_b['children']))
                                    <ul class="catalog__sub-items">
                                        @foreach($menu_b['children'] as $menu_c)
                                        <li class="catalog__sub-item ">
                                            <a class="link link--text @if(strpos($_SERVER['REQUEST_URI'], $menu_c['path']) !== false) catalog__sub-item--active @endif "  href="@if(!isset($menu_b['menu']))/catalog/@endif{{ $menu_c['path'] }}" title="">{{ $menu_c['title'] }}</a>
                                           {{-- <span class="catalog__num">787</span>--}}
                                            @if($menu_c['children'])
                                                <ul class="catalog__sub-items">
                                                    @foreach($menu_c['children'] as $menu_c_c)
                                                    <li class="catalog__sub-item ">
                                                        <a class="link link--text @if(strpos($_SERVER['REQUEST_URI'], $menu_c_c['path']) !== false) catalog__sub-item--active @endif " href="@if(!isset($menu_b['menu']))/catalog/@endif{{ $menu_c_c['path'] }}" title="">{{ $menu_c_c['title'] }}</a>
                                                        {{--<span class="catalog__num">1</span>--}}
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

                <h1 class="title title--size-m title--light text-center ">Купить женское нижнее белье в магазине SilkandLace в Москве — Каталог с выгодными ценами на женское белье от магазина "Шелк и Кружево"</h1>

                <div class="title title--size-s title--dim title--light text-center d-none d-md-block title--underline content__sub-title">{{--{{$all}} товаров--}}</div>
    @if (isset($filters['brand']))
                   <form name="_form" action="{{$_SERVER['REQUEST_URI']}}" method="get" class="filter form smartfilter">
                       <div class="filter__items">

                           <div class="dropdown filter__item">
                               <button class="btn " type="button" id="dropdownBrand" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   <div class="filter__open" >Бренд</div>
                               </button>
                               <div class="dropdown-menu filter__box" aria-labelledby="dropdownBrand">
                                   @foreach ($filters['brand'] as $id=>$brand)
                                       <div class="form-check">
                                           <input class="form-check-input" type="checkbox" name="filter_brand[]" value="{{$id}}" id="CheckBrand{{$id}}" @if(isset($_GET['filter_brand'])) @if(in_array($id, $_GET['filter_brand'])) checked @endif @endif>
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
                                           <input class="form-check-input" type="checkbox" name="filter_color[]" value="{{$id}}" id="CheckColor{{$id}}" @if(isset( $_GET['filter_color'])) @if(in_array($id, $_GET['filter_color'])) checked @endif @endif>
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
   @endif



                  {{-- <div id="app">--}}
                   <div>
                       <div id="goods_all" >

                               <products-component link="{{substr(stristr(url()->full(), "?"), 1)}}" path='{{ str_replace('catalog/', '', strstr(url()->current(), "catalog/"))}}' ></products-component>


                       </div>
                   </div>
                @if(!isset($filters))
                   @if($_SERVER['REQUEST_URI']!= '/catalog/')
                       <div class="title title--size-s title--dim title--light  title--underline content__sub-title">Смотрите также:</div>
                       <div class="description_section description_section_href">
                           @php($count=0)
                           @foreach ($filters['brand'] as $id=>$brand)
                               @php($count++)
                               @if ($count == 26)
                                   @break
                               @endif
                                   <a href="{{url()->current()}}?filter_brand%5B%5D={{$id}}">{{$name_category}} {{$brand}}</a>
                           @endforeach
                           @php($count=0)
                           @foreach ($filters['country'] as $id=>$country)
                               @php($count++)
                               @if ($count == 9)
                                   @break
                               @endif
                               <a href="{{url()->current()}}?filter_country%5B%5D={{$id}}">{{$name_category}} {{$country}}</a>
                           @endforeach
                           @php($count=0)
                           @foreach ($filters['color'] as $id=>$color)
                               @php($count++)
                               @if ($count == 13)
                                   @break
                               @endif
                               <a href="{{url()->current()}}?filter_color%5B%5D={{$color}}">{{$name_category}} {{$id}}</a>
                           @endforeach
                       </div>
                   @endif
                @endif

               </div>
           </div>


       </div>



   @endsection
