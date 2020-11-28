@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Редактирование поставщика @endslot
            @slot('parent') Главная @endslot
            @slot('active')  <a href="{{route('admin.providers.index')}}"> Поставщики </a> @endslot
        @endcomponent

        <hr/>



            {{-- Form include --}}
            <div class="row">
                <div class="col-md-8">
                    <form class="form-horizontal" action="{{route('admin.providers.update', $provider)}}" method="post"
                          enctype="multipart/form-data">
                        @method('PUT')
                        {{ csrf_field() }}
                        <div class="form-group ">
                            <label for="inputZip">Название</label>
                            <input type="text" name="provider_name" class="form-control" value="{{$provider->provider_name}}">
                        </div>
                        <div class="form-group ">
                            <label for="inputZip">xml id</label>
                            <input type="text" name="xml_id" class="form-control" value="{{$provider->xml_id}}">
                        </div>
                        <hr><br>
                        <button type="submit" class="btn btn-primary float-right">Сохранить</button>
                    </form>
                    <form onsubmit="if(confirm('Удалить?')){ return true}else{return false}"
                          action="{{route('admin.providers.destroy', $provider)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-danger float-left" type="submit" value="Удалить">
                    </form>
                </div>
                <div class="col-md-4">

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
