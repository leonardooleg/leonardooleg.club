@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Добавления страны @endslot
            @slot('parent') Главная @endslot
            @slot('active') Страны @endslot
        @endcomponent

        <hr>
        <a href="{{route('admin.countries.create')}}" class="btn btn-primary float-right"><i
                class="fa fa-plus-square-o"></i> Добавить страну</a>


        <table class="table table-striped">
            <thead>
            <th>Наименование</th>

            <th class="text-right">Изменить</th>
            </thead>
            <tbody>
            @if(isset($countries))
                @foreach ($countries as $country)
                    <tr>
                        <td><a href="countries/{{$country->id}}/edit">{{$country->name_country}}</a></td>

                        <td>
                            <a href="countries/{{$country->id}}/edit"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">
                    <ul class="pagination pull-right">
                        @if(isset($countries)) {{$countries->links()}}  @endif
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection
