@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Редактирование страны @endslot
            @slot('parent') Главная @endslot
            @slot('active') <a href="{{route('admin.countries.index')}}"> Страны </a>@endslot
        @endcomponent

        <hr/>



            {{-- Form include --}}
            <div class="row">
                <div class="col-md-8">
                    <form class="form-horizontal" action="{{route('admin.countries.update', $country)}}" method="post"
                          enctype="multipart/form-data">
                        @method('PUT')
                        {{ csrf_field() }}
                        <div class="form-group ">
                            <label for="inputZip">Название</label>
                            <input type="text" name="name_country" class="form-control" value="{{$country->name_country}}">
                        </div>

                        <hr><br>
                        <button type="submit" class="btn btn-primary float-right">Сохранить</button>
                    </form>
                    <form onsubmit="if(confirm('Удалить?')){ return true}else{return false}"
                          action="{{route('admin.countries.destroy', $country)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-danger float-left" type="submit" value="Удалить">
                    </form>
                </div>
                <div class="col-md-4">
                    <h4>Уже добавленные цвета </h4>
                    <ul class="list-group">
                        @foreach($countries as $country)
                            <li class="list-group-item " style="background-country: {{$country->code_country}} ;text-shadow: #fff -1px -1px 0, #000 1px 1px 0;">{{$country->name_country}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>



        <script>
            function deleteCategory(f) {
                if (confirm("Вы уверены, что хотите удалить выделенный пункт?\nЭта операция не восстановима."))
                    f.submit();
            }

            console.log('delete')
        </script>
    </div>
@endsection
