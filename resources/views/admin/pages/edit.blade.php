@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Редактирование страницы @endslot
            @slot('parent') Главная @endslot
            @slot('active') <a href="{{route('admin.pages.index')}}"> Страницы </a>@endslot
        @endcomponent

        <hr/>



            {{-- Form include --}}

                    <form class="form-horizontal" action="{{route('admin.pages.update', $page)}}" method="post"
                          enctype="multipart/form-data">
                        @method('PUT')
                        {{ csrf_field() }}

                        <div class="form-group ">
                            <label for="inputZip"><strong>Название</strong></label>
                            <input type="text" name="title" class="form-control" value="{{$page->title}}">
                        </div>
                        <div class="form-group ">
                            <label for="inputZip"><strong>Ссылка</strong></label>
                            <div class="input-group mb-3">
                                <input type="text" name="url" class="form-control" placeholder="Автоматическая генерация или введите свою" value="{{$page->url ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <label for="inputZip"><strong>Текст</strong></label>
                            <textarea  rows="20" name="text" id="description" class="summernote form-control">{{$page->text}}</textarea>
                        </div>


  <hr><br>
                        <button type="submit" class="btn btn-primary float-right">Сохранить</button>
                    </form>
                    <form onsubmit="if(confirm('Удалить?')){ return true}else{return false}"
                          action="{{route('admin.pages.destroy', $page)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-danger float-left" type="submit" value="Удалить">
                    </form>




        <script>
            function deleteCategory(f) {
                if (confirm("Вы уверены, что хотите удалить выделенный пункт?\nЭта операция не восстановима."))
                    f.submit();
            }

        </script>
    </div>
@endsection
