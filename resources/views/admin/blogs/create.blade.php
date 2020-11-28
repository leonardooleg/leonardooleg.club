@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Добавить блог @endslot
            @slot('parent') Главная @endslot
            @slot('active') Блог @endslot
        @endcomponent

        <hr/>

        <form class="form-horizontal" action="{{route('admin.blogs.store')}}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            {{-- Form include --}}
            <label for=""><strong>Статус</strong></label>
            <select class="form-control" name="published">

                    <option value="0">Не опубликовано</option>
                    <option value="1">Опубликовано</option>

            </select>
                    <div class="form-group ">
                        <label for="inputZip">Название</label>
                        <input type="text" name="title" class="form-control" id="">
                    </div>
            <div class="form-group ">
                <label for="inputZip"><strong>Ссылка</strong></label>
                <div class="input-group mb-3">
                    <input type="text" name="url" class="form-control" placeholder="Автоматическая генерация или введите свою" value="" >
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">.html</span>
                    </div>
                </div>
            </div>
            <div class="form-group ">
                <label for="inputZip">Текст</label>
                <textarea  rows="20" name="text" id="description" class="summernote form-control" required></textarea>
            </div>
                    <div class="form-group ">
                        <label for="inputZip">Заглавная картинка</label>
                        <input type="file" class="form-control-file" name="img" id="exampleFormControlFile1" required>
                    </div>


                    <hr><br>
                    <button type="submit" class="btn btn-primary float-right">Добавить</button>


        </form>
    </div>

@endsection
