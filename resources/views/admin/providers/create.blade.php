@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Добавить поставщика @endslot
            @slot('parent') Главная @endslot
            @slot('active') Поставщик @endslot
        @endcomponent

        <hr/>

        <form class="form-horizontal" action="{{route('admin.providers.store')}}" method="post">
            {{ csrf_field() }}

            {{-- Form include --}}
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group ">
                        <label for="inputZip">Название</label>
                        <input type="text" name="provider_name" class="form-control" id="">
                    </div>
                    <div class="form-group ">
                        <label for="inputZip">xml id</label>
                        <input type="text" name="xml_id" class="form-control" id="">
                    </div>
                    <hr><br>
                    <button type="submit" class="btn btn-primary float-right">Добавить</button>
                </div>
                <div class="col-md-4">
                    <h4>Уже добавленные поставщики </h4>
                    <ul class="list-group">
                        @foreach($providers as $provider)
                            <li class="list-group-item ">{{$provider->provider_name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>



        </form>
    </div>

@endsection
