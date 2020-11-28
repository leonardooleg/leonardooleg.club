@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Добавленные блоги @endslot
            @slot('parent') Главная @endslot
            @slot('active') Блоги @endslot
        @endcomponent

        <hr>
        <a href="{{route('admin.blogs.create')}}" class="btn btn-primary float-right"><i
                class="fa fa-plus-square-o"></i> Добавить блог</a>


        <table class="table table-striped">
            <thead>
            <th>Картинка</th>

            <th>Наименование</th>
            <th class="text-right">Изменить</th>
            </thead>
            <tbody>
            @if(isset($blogs))
                @foreach ($blogs as $blog)
                    <tr>
                        <td>
                            <div class=""> <img src="/storage/{{$blog->img ?? ''}}" style="height: 50px; width: auto"> </div>
                        </td>
                        <td><a href="blogs/{{$blog->id}}/edit">{{$blog->title}}</a></td>

                        <td>
                            <a href="blogs/{{$blog->id}}/edit"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">
                    <ul class="pagination pull-right">
                        @if(isset($blogs)) {{$blogs->links()}}  @endif
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection
