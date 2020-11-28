@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Добавления поставщиков @endslot
            @slot('parent') Главная @endslot
            @slot('active') Поставщики @endslot
        @endcomponent

        <hr>

        <a href="{{route('admin.providers.create')}}" class="btn btn-primary float-right"><i
                class="fa fa-plus-square-o"></i> Добавить поставщика</a>


        <table class="table table-striped">
            <thead>
            <th>Наименование</th>

            <th class="text-right">Изменить</th>
            </thead>
            <tbody>
            @forelse ($providers as $provider)
                <tr>
                    <td><a href="providers/{{$provider->id}}/edit">{{$provider->provider_name}}</a></td>

                    <td><a href="providers/{{$provider->id}}/edit"><i class="fa fa-edit"></i></a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">
                    <ul class="pagination pull-right">
                        {{$providers->links()}}
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection
