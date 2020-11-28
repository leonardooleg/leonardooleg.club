@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Добавить бренд @endslot
            @slot('parent') Главная @endslot
            @slot('active') Бренды @endslot
        @endcomponent

        <hr/>

        <form class="form-horizontal" action="{{route('admin.brands.store')}}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            {{-- Form include --}}
                    <div class="form-group ">
                        <label for="inputZip"><strong>Название</strong></label>
                        <input type="text" name="name_brand" class="form-control" id="">
                    </div>
            <div class="form-group ">
                <label for="inputZip"><strong>Ссылка</strong></label>
                <div class="input-group mb-3">
                    <input type="text" name="url" class="form-control" placeholder="Автоматическая генерация или введите свою" value="">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">.html</span>
                    </div>
                </div>
            </div>
                    <div class="form-group ">
                        <label for="inputZip"><strong>Описание</strong></label>
                        <textarea  rows="7" name="description_brand" class="summernote form-control" id=""></textarea>
                    </div>
                    <div class="form-group ">
                        <label for="inputZip"><strong>Размер бренда</strong></label>
                        <textarea rows="7" name="sizes_brand" id="description" class="summernote form-control" id=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1"><strong>Логотип</strong></label>
                        <input type="file" class="form-control-file" name="logo_brand" id="exampleFormControlFile1">
                    </div>




                    <hr><br>
                    <button type="submit" class="btn btn-primary float-right">Добавить</button>


        </form>
    </div>

@endsection
