@extends('layouts.app')

@section('title', 'Блоги')

@section('content')
    <div class="container container-my">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="/" class="link breadcrumbs__link">Главная</a> </li>
                    <li class="breadcrumb-item"><a href="/brands" class="link breadcrumbs__link">Бренды</a></li>
            </ol>
        </nav>


            <br>
            <h2 class=" text-center content__title">Бренды</h2>
        <div class="text-center ">{{$count}} брендов</div>
            <hr class="sep page__sep">
            <div class="dn title title--size-s title--light title--center content__title">Блог магазина «Шелк и кружево»</div>
            <div class="container-sm brands">

                <div class=" alphabet text-center">

                    <div class="alphabet__items">
                        <div class="alphabet__item dn">
                            <a class="link link--text" href="#">0–9</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#A">A</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#B">B</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#C">C</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#D">D</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#E">E</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#F">F</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#G">G</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#H">H</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#I">I</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#J">J</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#K">K</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#L">L</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#M">M</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#N">N</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#O">O</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#P">P</a>
                        </div>
                        <div class="alphabet__item alphabet__item--disabled">
                            <a class="link link--text" href="#Q">Q</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#R">R</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#S">S</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#T">T</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#U">U</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#V">V</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#W">W</a>
                        </div>
                        <div class="alphabet__item alphabet__item--disabled">
                            <a class="link link--text" href="#X">X</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#Y">Y</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#Z">Z</a>
                        </div>
                        <div class="alphabet__item ">
                            <a class="link link--text" href="#А–Я">А–Я</a>
                        </div>
                    </div>
                </div>

                @foreach ($brands as $id=>$brand)
                    <div class="container content__brands">
                        <br>
                        <div id="{{$id}}" class="title title--size-l text-center content__title">{{$id}}</div>
                        <div class="list--brands row">
                            @foreach ($brand as $brand_arr)
                            <div class="list__item col-md-3 text-center">
                                <a class="link link--text" href="/brands/{{$brand_arr['url']}}.html">{{$brand_arr['name_brand']}}</a>
                            </div>
                            @endforeach

                        </div>

                    </div>
                    <hr class="sep page__sep">
                @endforeach


            </div>


    </div>



@endsection
