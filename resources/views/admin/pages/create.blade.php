@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Добавить страницу @endslot
            @slot('parent') Главная @endslot
            @slot('active') Страница @endslot
        @endcomponent

        <hr/>

        <form class="form-horizontal" action="{{route('admin.pages.store')}}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            {{-- Form include --}}
                    <div class="form-group ">
                        <label for="inputZip">Название</label>
                        <input type="text" name="title" class="form-control" id="">
                    </div>
            <div class="form-group ">
                <label for="inputZip"><strong>Ссылка</strong></label>
                <div class="input-group mb-3">
                    <input type="text" name="url" class="form-control" placeholder="Автоматическая генерация или введите свою" value="" >
                </div>
            </div>
            <div class="form-group ">
                <label for="inputZip">Текст</label>
                <textarea  rows="20" name="text" id="description" class="summernote form-control" required></textarea>
            </div>

                    <hr><br>
                    <button type="submit" class="btn btn-primary float-right">Добавить</button>


        </form>
    </div>

@endsection
