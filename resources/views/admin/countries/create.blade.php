@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Добавить страну @endslot
            @slot('parent') Главная @endslot
            @slot('active') Страны @endslot
        @endcomponent

        <hr/>

        <form class="form-horizontal" action="{{route('admin.countries.store')}}" method="post">
            {{ csrf_field() }}

            {{-- Form include --}}
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group ">
                        <label for="inputZip">Название</label>
                        <input type="text" name="name_country" class="form-control" id="">
                    </div>

                    <hr><br>
                    <button type="submit" class="btn btn-primary float-right">Добавить</button>
                </div>
                <div class="col-md-4">
                    <h4>Уже добавленные страны </h4>
                    <ul class="list-group">
                        @foreach($countries as $country)
                            <li class="list-group-item ">{{$country->name_country}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>



        </form>
    </div>

@endsection
