@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Добавить расцветку @endslot
            @slot('parent') Главная @endslot
            @slot('active') Расцветки @endslot
        @endcomponent

        <hr/>

        <form class="form-horizontal" action="{{route('admin.colors.store')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            {{-- Form include --}}
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group ">
                        <label for="inputZip">Название</label>
                        <input type="text" name="name_color" class="form-control" id="">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Загрузить файл цвета</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="img_color"  class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Файл</label>
                        </div>
                    </div>


                    <div class=" form-row">
                        <label for="">Для бренда</label>
                        <select class="form-control" name="brand_id">
                            <option value="0">-- для всех брендов --</option>
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}" >{{$brand->name_brand}}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr><br>
                    <button type="submit" class="btn btn-primary float-right">Добавить</button>
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



        </form>
    </div>

@endsection
