@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Добавить бренды @endslot
            @slot('parent') Главная @endslot
            @slot('active') Бренды @endslot
        @endcomponent

        <hr>
        <a href="{{route('admin.brands.create')}}" class="btn btn-primary float-right"><i
                class="fa fa-plus-square-o"></i> Добавить бренд</a>


        <table class="table table-striped">
            <thead>
            <th>Логотип</th>

            <th>Наименование</th>
            <th class="text-right">Изменить</th>
            </thead>
            <tbody>
            @if(isset($brands))
                @foreach ($brands as $brand)
                    <tr>
                        <td>
                            <div class=""> <img src="/storage/{{$brand->logo_brand ?? ''}}" style="height: 50px; width: auto"> </div>
                        </td>
                        <td><a href="brands/{{$brand->id}}/edit">{{$brand->name_brand}}</a></td>

                        <td>
                            <a href="brands/{{$brand->id}}/edit"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">
                    <ul class="pagination pull-right">
                        @if(isset($brands)) {{$brands->links()}}  @endif
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection
