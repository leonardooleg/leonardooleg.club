@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Редактирование брендов @endslot
            @slot('parent') Главная @endslot
            @slot('active') <a href="{{route('admin.brands.index')}}"> Бренды </a>@endslot
        @endcomponent

        <hr/>



            {{-- Form include --}}

                    <form class="form-horizontal" action="{{route('admin.brands.update', $brand)}}" method="post"
                          enctype="multipart/form-data">
                        @method('PUT')
                        {{ csrf_field() }}
                        <div class="form-group ">
                            <label for="inputZip"><strong>Название</strong></label>
                            <input type="text" name="name_brand" class="form-control" value="{{$brand->name_brand}}">
                        </div>
                        <div class="form-group ">
                            <label for="inputZip"><strong>Ссылка</strong></label>
                            <div class="input-group mb-3">
                                <input type="text" name="url" class="form-control" placeholder="Автоматическая генерация или введите свою" value="{{$brand->url ?? ''}}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">.html</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="inputZip"><strong>Описание</strong></label>
                            <textarea  rows="7" name="description_brand" class="summernote form-control" >{{$brand->description_brand}}</textarea>
                        </div>
                        <div class="form-group ">
                            <label for="inputZip"><strong>Размер бренда</strong></label>
                            <textarea rows="7" name="sizes_brand" class="summernote form-control" >{{$brand->sizes_brand}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1"><strong>Логотип</strong></label>
                            <div class=" media">
                                <img src="/storage/{{$brand->logo_brand ?? 'https://silkandlace.ru/upload/iblock/a52/a52a90cd6fa595a1925b3187e0b54d23.jpg'}}" class="mr-3" style="height: 250px; width: auto">
                                <div class="media-body">
                                    <input type="file" class="form-control-file" name="logo_brand" id="exampleFormControlFile1">
                                </div>
                            </div>
                        </div>


                        <hr><br>
                        <button type="submit" class="btn btn-primary float-right">Сохранить</button>
                    </form>
                    <form onsubmit="if(confirm('Удалить?')){ return true}else{return false}"
                          action="{{route('admin.brands.destroy', $brand)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-danger float-left" type="submit" value="Удалить">
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
