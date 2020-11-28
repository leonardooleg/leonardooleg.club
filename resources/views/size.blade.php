@extends('layouts.app')

@section('title', 'Таблица размеров '.$size->name_brand)

@section('content')
    <div class="container container-my">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="/" class="link breadcrumbs__link">Главная</a> </li>
                    <li class="breadcrumb-item"><a href="/sizes" class="link breadcrumbs__link">Таблица размеров</a></li>
                    <li class="breadcrumb-item"><a  class="link breadcrumbs__link">{{$size->name_brand}}</a></li>
            </ol>
        </nav>


            <br>
            <h2 class=" text-center content__title">Таблица размеров </h2>
        <div class="text-center ">Как узнать размер нижнего белья?</div>
            <hr class="sep page__sep">

            <div class="container-fluid sizes">
                <div class="row proportions">
                    <div class="col-md-2">
                        <div class="title title--light">Выберите бренд:</div>
                        <div class=" proportions__nav">
                            @foreach ($brands as $brand)
                                <div class="list__item">
                                    <a class="link link--inherit" href="/sizes/{{$brand['url']}}.html">{{$brand['name_brand']}}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="proportions__question"><span>Есть вопросы?</span> Звоните
                            <a class="link link--text" href="tel:+74951338608">+7 (495) 133-86-08</a>
                        </div>
                        <div class="proportions__top">Российские размеры
                            <div class="title proportions__name">Размеры {{$size->name_brand}}</div>
                        </div>
                        <div id="cont">
                            {!! $size->sizes_brand !!}
                        </div>
                        <hr>

                        <div class="proportions__content">

                            <div class="proportions__gap">
                                <div class="proportions__schema">
                                    <div class="proportions__model">
                                        <img class="img loading" src="/image/girl.png" alt="" data-was-processed="true">
                                        <div class="proportions__pointer" data-point="1"></div>
                                        <div class="proportions__pointer" data-point="2"></div>
                                        <div class="proportions__pointer" data-point="3"></div>
                                        <div class="proportions__pointer" data-point="4"></div>
                                    </div>
                                    <div class="proportions__box" data-point="1">
                                        <p class="paragraph">Чтобы определить размер <b>чашки бюстгальтера</b>, вам необходимо замерить <b>обхват груди (ОГ)</b> <i>(см. точку № 1)</i> по наиболее выступающим точкам
                                        </p>
                                    </div>
                                    <div class="proportions__box" data-point="2">
                                        <p class="paragraph">Чтобы определить <b>основной размер бюстгальтера</b>, вам необходимо замерить <b>обхват под грудью (ОПГ)</b> <i>(см. точку № 2)</i>
                                        </p>
                                    </div>
                                    <div class="proportions__box" data-point="3">
                                        <p class="paragraph">Чтобы определить <b>размер трусиков</b>, вам необходимо замерить <b>обхват талии</b> <i>(см. точку № 3)</i>, а также <b>обхват бедер</b> <i>(см. точку № 4)</i> по наиболее выступающим точкам
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <p style="text-align: center;">
                                <b>Удачных покупок!</b>
                            </p>

                            <blockquote>
                                Остались вопросы? Звоните +7 (495) 133-86-08
                            </blockquote>
                            <table width="100%" cellpadding="0" cellspacing="0" align="left" class="razmer">
                                <colgroup><col> <col></colgroup>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="lof-readmore">
                                           @foreach($brands as $brand) @if($brand['name_brand']==$size->name_brand) <a href="/brands/{{$brand['url']}}.html">О производителе</a>@endif @endforeach
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>


                        </div>






                    </div>
                </div>





            </div>


    </div>



@endsection
