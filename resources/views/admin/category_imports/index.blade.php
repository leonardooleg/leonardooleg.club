@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Редирект категорий для импорта @endslot
            @slot('parent') Главная @endslot
            @slot('active') Подстановка категории для импорта@endslot
        @endcomponent


        <div class="mb-3">
            <a class="btn btn-primary float-left" href="{{ url()->previous() }}" role="button">Назад</a>
            <a href="{{route('admin.category-import.create')}}" class="btn btn-success float-right"><i class="fa fa-plus-square-o"></i> Создать подстановочную категорию</a>
        </div>
       <br>
       <br>
        <div class="card mb-4">
            <div class="card-header"></div>
            <div class="card-body">
                <table class="table table-striped mt-3 pt-3">
            <thead>
            <th>Категория с ипорта</th>
            <th>Нужная категория</th>
            <th class="text-right">Изменить</th>
            </thead>
            <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>  <a href="/admin/category-import/{{$category->id}}/edit">{{$category->import_name}}</a></td>
                    <td>
                        @foreach($all_category as $one_category)
                            @if($category->category_id == $one_category->id)
                                {{$one_category->title}}
                                @break
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <a href="{{route('admin.category-import.edit', $category)}}"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center"><h2>категорий нету</h2></td>
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
