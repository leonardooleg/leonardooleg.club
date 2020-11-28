@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Добавить размер @endslot
            @slot('parent') Главная @endslot
            @slot('active') Размеры @endslot
        @endcomponent

        <hr>
        <a href="{{route('admin.sizes.create')}}" class="btn btn-primary float-right"><i
                class="fa fa-plus-square-o"></i> Добавить размер</a>


        <table class="table table-striped">
            <thead>
            <th>Категория</th>
            <th>Бренд</th>
            <th>Размер</th>
            <th>Рус. размер</th>
            <th class="text-right">Изменить</th>
            </thead>
            <tbody>
            @if(isset($sizes))
                @foreach ($sizes as $size)
                    <tr>
                        <td> {{$size->category_name}} </td>
                        <td> {{$size->name_brand}} </td>
                        <td> {{$size->brand_name_size}} </td>
                        <td> {{$size->rus_name_size}} </td>

                        <td>
                            <a href="sizes/{{$size->id}}/edit"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">
                    <ul class="pagination pull-right">
                        @if(isset($sizes)) {{$sizes->links()}}  @endif
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection
