@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">


        @component('admin.components.breadcrumb')
            @slot('title') Редактирование категории для импорта @endslot
            @slot('parent') Главная @endslot
            @slot('active') Категория для импорта @endslot
        @endcomponent

        <hr />



        <form class="form-horizontal" action="{{route('admin.category-import.update', $category)}}" method="post">
            @csrf
            @method('PUT')

            {{-- Form include --}}
            @include('admin.category_imports.partials.form')

        </form>
        <form  onsubmit="deleteCategory(this);return false;" action="{{route('admin.category-import.destroy', $category)}}" method="post">
            @csrf
            @method('DELETE')
            <input class="btn btn-danger float-right" type="submit" value="Удалить">
        </form>

    <script>
        function deleteCategory(f) {
            if (confirm("Вы уверены, что хотите удалить выделенный пункт?\nЭта операция не восстановима."))
                f.submit();
        }
        console.log('delete')
    </script>
    </div>
@endsection
