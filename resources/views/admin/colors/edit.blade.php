@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Редактирование расцветки @endslot
            @slot('parent') Главная @endslot
            @slot('active') <a href="{{route('admin.colors.index')}}"> Расцветки </a>@endslot
        @endcomponent

        <hr/>



            {{-- Form include --}}
            <div class="row">
                <div class="col-md-8">
                    <form class="form-horizontal" action="{{route('admin.colors.update', $color)}}" method="post"
                          enctype="multipart/form-data">
                        @method('PUT')
                        {{ csrf_field() }}
                        <div class="form-group ">
                            <label for="inputZip">Название</label>
                            <input type="text" name="name_color" class="form-control" value="{{$color->name_color ?? ''}}">
                        </div>
                        <div class=" form-row">
                            <label class=" col-md-12" for="basic-url">Цвет</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Загрузить файл цвета</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="img_color"  class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Файл</label>
                                </div>
                                <div class="input-group-prepend">
                                    <img src="{{$color->img_color ?? ''}}" style="height: 40px;width: auto; border: 2px solid black;  margin-left: 5px;">
                                </div>
                            </div>
                        </div>
                        <div class=" form-row">
                            <label for="">Для бренда</label>
                            <select class="form-control" name="brand_id">
                                <option value="0">-- для всех брендов --</option>
                                @foreach($brands as $brand)
                                    <option value="{{$brand->id}}" @if($brand->id==$color->brand_id) selected @endif>{{$brand->name_brand}}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr><br>
                        <button type="submit" class="btn btn-primary float-right">Сохранить</button>
                    </form>
                    <form onsubmit="if(confirm('Удалить?')){ return true}else{return false}"
                          action="{{route('admin.colors.destroy', $color)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-danger float-left" type="submit" value="Удалить">
                    </form>
                </div>
                <div class="col-md-4">
                    <h4>Уже добавленные цвета </h4>
                    <ul class="list-group">
                        @foreach($colors as $color)
                            <li class="list-group-item " ><img src="{{$color->img_color}}" style="height: 35px"> {{$color->name_color}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>



        <script type="application/javascript">
           function deleteCategory(f) {
                if (confirm("Вы уверены, что хотите удалить выделенный пункт?\nЭта операция не восстановима."))
                    f.submit();
            }

            console.log('delete')
        </script>
    </div>
@endsection
