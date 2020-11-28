@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Настройка магазина @endslot
            @slot('parent') Главная @endslot
            @slot('active') Магазин @endslot
        @endcomponent

        <hr />



        <form class="form-horizontal" action="{{route('admin.shop.update', $shop)}}" method="post">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-4 data_trek">
                    <div class="fon-cart-2">
                        <h3>Настройки продаж</h3>
                        <br>
                        <label for="basic-url">Наценка к товарам</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="markup" value="{{$shop->markup}}"  aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2"> % </span>
                            </div>


                        </div>



<br>
<br>



                <input class="btn btn-primary" type="submit" value="Сохранить">
            </div>

        </form>

    </div>
    <script type="application/javascript">
        function deleteCategory(f) {
            if (confirm("Вы уверены, что хотите удалить выделенный пункт?\nЭта операция не восстановима."))
                f.submit();
        }
        console.log('delete')
    </script>

@endsection
