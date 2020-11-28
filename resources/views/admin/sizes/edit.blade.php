@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Редактирование размеров @endslot
            @slot('parent') Главная @endslot
            @slot('active') <a href="{{route('admin.sizes.index')}}"> Размеры </a>@endslot
        @endcomponent

        <hr/>



            {{-- Form include --}}

                    <form class="form-horizontal" action="{{route('admin.sizes.update', $size)}}" method="post"
                          enctype="multipart/form-data">
                        @method('PUT')
                        {{ csrf_field() }}
                        @include('admin.sizes.partials.form')
                    </form>
                    <form onsubmit="if(confirm('Удалить?')){ return true}else{return false}"
                          action="{{route('admin.sizes.destroy', $size)}}" method="post">
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
