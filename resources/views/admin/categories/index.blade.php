@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Список категорий @endslot
            @slot('parent') Главная @endslot
            @slot('active') Категории @endslot
        @endcomponent


        <div class="mb-3">
            <a class="btn btn-primary float-left" href="{{ url()->previous() }}" role="button">Назад</a>
            <a href="{{route('admin.category.create')}}" class="btn btn-success float-right"><i class="fa fa-plus-square-o"></i> Создать категорию</a>
        </div>
       <br>
       <br>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Категория: <a href="/admin/category/{{$head[0]->id ?? '#'}}/children">{{$parent->title ?? 'Это родительськая'}}</a></div>
            <div class="card-body">
                <table class="table table-striped mt-3 pt-3">
            <thead>
            <th>Наименование</th>
            <th>Родитель</th>
            <th>Опубликована</th>
            <th class="text-right">Изменить</th>
            </thead>
            <tbody>
            @forelse ($categories->sortByDesc('id') as $category)
                <tr>
                    <td>  <a href="/admin/category/{{$category->id}}/children">{{$category->title}}</a></td>
                    <td>
                        @if($category->parent_id)дочерняя {{$parent->title ?? ''}}
                        @else <b>Главная категория</b>
                        @endif
                    </td>
                    <td>
                        @if($category->published==1)Опубликована
                        @else Нет
                        @endif
                            </td>
                    <td>
                        <a href="{{route('admin.category.edit', $category)}}"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center"><h2>Входящих подкатегорий нету</h2></td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">
                    <ul class="pagination pull-right">
                        {{$categories->links()}}
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>
            </div>
        </div>
    </div>
@endsection
