@extends('admin.layouts.app_admin')

@section('content')

    <div class="container-fluid">

        @component('admin.components.breadcrumb')
            @slot('title') Редактирование товара @endslot
            @slot('parent') Главная @endslot
            @slot('active') <a href="{{route('admin.products.index')}}"> Товар </a>@endslot
        @endcomponent

        <hr/>



            {{-- Form include --}}
            <form class="form-horizontal" action="{{route('admin.products.update', $product)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                {{ csrf_field() }}
                <button type="button" class="btn btn-link float-right"><a href="/{{$product->getUrl()}}" target="_blank"> Посмотреть на сайте</a></button>
                @include('admin.products.partials.form')
                <button type="submit" class="btn btn-primary float-right">Сохранить</button>
            </form>
            <form onsubmit="if(confirm('Удалить?')){ return true}else{return false}"
                  action="{{route('admin.products.destroy', $product)}}" method="post">
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
