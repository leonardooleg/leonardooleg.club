@extends('layouts.app')


@section('title', $blog->title)

@section('content')
    <div class="container container-my">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="/" class="link breadcrumbs__link">Главная</a> </li>
                <li class="breadcrumb-item"><a href="/blogs" class="link breadcrumbs__link">Блоги</a></li>
                <li class="breadcrumb-item"><a  class="link breadcrumbs__link">{{$blog->title}}</a></li>

            </ol>
        </nav>


        <br>
        <h2 class=" text-center content__title">{{$blog->title}}</h2>
        <hr class="sep page__sep">
        <div class="dn title title--size-s title--light title--center content__title">Блог магазина «Шелк и кружево»</div>
        <div class="post__content wysiwyg row ">

        {!! $blog->text !!}


            <a href="/blog/" style="margin: 20px 0px 0px; display: inline-block;">
                <button class="button button--default btn-dark">К списку постов</button>
            </a>
</div>


</div>



@endsection
