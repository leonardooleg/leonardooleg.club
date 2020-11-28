@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Добавления тканей @endslot
            @slot('parent') Главная @endslot
            @slot('active') Расцветки @endslot
        @endcomponent

        <hr>
        <a href="{{route('admin.colors.create')}}" class="btn btn-primary float-right"><i
                class="fa fa-plus-square-o"></i> Добавить расцветку</a>


        <table class="table table-striped">
            <thead>
            <th>Наименование</th>

            <th>Бренд</th>
            <th class="text-right">Изменить</th>
            </thead>
            <tbody>
            @if(isset($colors))
                @foreach ($colors as $color)
                    <tr>
                        <td><a href="colors/{{$color->id}}/edit">{{$color->name_color}}</a></td>

                        <td>{{$color->name_brand}}</td>
                        <td><img src="{{$color->img_color}}" style="height: 35px"></td>
                        <td>
                            <a href="colors/{{$color->id}}/edit"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">
                    <ul class="pagination pull-right">
                        @if(isset($colors)) {{$colors->links()}}  @endif
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection
