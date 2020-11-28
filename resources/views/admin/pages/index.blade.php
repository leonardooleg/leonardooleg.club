@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Добавленные страницы @endslot
            @slot('parent') Главная @endslot
            @slot('active') Страницы @endslot
        @endcomponent

        <hr>
        <a href="{{route('admin.pages.create')}}" class="btn btn-primary float-right"><i
                class="fa fa-plus-square-o"></i> Добавить Страницу</a>


        <table class="table table-striped">
            <thead>
            <th>Наименование</th>
            <th class="text-right">Изменить</th>
            </thead>
            <tbody>
            @if(isset($pages))
                @foreach ($pages as $page)
                    <tr>
                        <td><a href="pages/{{$page->id}}/edit">{{$page->title}}</a></td>

                        <td>
                            <a href="pages/{{$page->id}}/edit"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">
                    <ul class="pagination pull-right">
                        @if(isset($pages)) {{$pages->links()}}  @endif
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection
