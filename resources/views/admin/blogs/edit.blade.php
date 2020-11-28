@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Редактирование блога @endslot
            @slot('parent') Главная @endslot
            @slot('active') <a href="{{route('admin.blogs.index')}}"> Блоги </a>@endslot
        @endcomponent

        <hr/>



            {{-- Form include --}}

                    <form class="form-horizontal" action="{{route('admin.blogs.update', $blog)}}" method="post"
                          enctype="multipart/form-data">
                        @method('PUT')
                        {{ csrf_field() }}
                        <label for=""><strong>Статус</strong></label>
                        <select class="form-control" name="published">
                            @if (isset($blog->id))
                                <option value="0" @if ($blog->published == 0) selected="" @endif>Не опубликовано</option>
                                <option value="1" @if ($blog->published == 1) selected="" @endif>Опубликовано</option>
                            @else
                                <option value="0">Не опубликовано</option>
                                <option value="1">Опубликовано</option>
                            @endif
                        </select>
                        <div class="form-group ">
                            <label for="inputZip"><strong>Название</strong></label>
                            <input type="text" name="title" class="form-control" value="{{$blog->title}}">
                        </div>
                        <div class="form-group ">
                            <label for="inputZip"><strong>Ссылка</strong></label>
                            <div class="input-group mb-3">
                                <input type="text" name="url" class="form-control" placeholder="Автоматическая генерация или введите свою" value="{{$blog->url ?? ''}}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">.html</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <label for="description"><strong>Текст</strong></label>
                          <textarea rows="20" name="text" id="description" class="summernote form-control">{{$blog->text}}</textarea>
                        </div>

                        <label for="inputZip"><strong>Заглавная картинка</strong></label>
                        <div class="row">
                            <div class="col">
                                <img src="/storage/{{$blog->img ?? ''}}" style="width: auto; height: 250px">
                            </div>
                            <div class="col">
                                <div class="form-group ">
                                    <label for="inputZip">загрузить картинку</label>
                                    <input type="file" class="form-control-file" name="img" id="exampleFormControlFile1">
                                </div>

                            </div>
                        </div>
  <hr><br>
                        <button type="submit" class="btn btn-primary float-right">Сохранить</button>
                    </form>
                    <form onsubmit="if(confirm('Удалить?')){ return true}else{return false}"
                          action="{{route('admin.blogs.destroy', $blog)}}" method="post">
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
