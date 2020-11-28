@extends('layouts.app')


@section('title',  $page->title ?? 'Новинки')

@section('content')
    <div class="container container-my page-site">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="/" class="link breadcrumbs__link">Главная</a> </li>
                <li class="breadcrumb-item"><a  class="link breadcrumbs__link">{{$page->title ?? 'Новинки'}}</a></li>

            </ol>
        </nav>



        {!! $page->text ?? ''!!}

</div>


</div>



@endsection
