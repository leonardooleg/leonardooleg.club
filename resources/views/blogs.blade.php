@extends('layouts.app')

@section('title', 'Блоги')

@section('content')
    <div class="container container-my blogs-p">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="/" class="link breadcrumbs__link">Главная</a> </li>
                    <li class="breadcrumb-item">
                    <a href="/blog" class="link breadcrumbs__link">Блоги</a></li>

            </ol>
        </nav>


            <br>
            <h2 class=" text-center content__title">Блог по женскому нижнему белью и одежде для дома</h2>
            <hr class="sep page__sep">
            <div class="dn title title--size-s title--light title--center content__title">Блог магазина «Шелк и кружево»</div>
            <div class="content__news row">

                @foreach ($blogs as $blog)
                <div class="shortstory col-md-4">
                    <div class="shortstory__image text-center">
                        <a href="/blog/{{$blog->url}}.html">
                            <img class="img loading" src="/storage/{{$blog->img}}" alt="{{$blog->title}}"  data-was-processed="true">
                        </a>
                    </div>
                    <div class="shortstory__title">
                        <div class="title">{{$blog->title}}</div>
                    </div>
                    <div class="text text--light">
                        <p class="">
                            {{htmlspecialchars(strip_tags($blog->text), ENT_QUOTES)}}
                        </p>
                    </div>
                    <div class="shortstory__more">
                        <a class="link link--inherit" href="/blog/{{$blog->url}}.html">Подробнее</a>
                    </div>
                </div>
                @endforeach

            </div>

        <div class="pagination float-right">

                {{ $blogs->links() }}
        </div>


    </div>



@endsection
