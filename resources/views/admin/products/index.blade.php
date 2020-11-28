@extends('admin.layouts.app_admin')

@section('content')

    <div class="container-fluid">

        @component('admin.components.breadcrumb')
            @slot('title') Добавления товаров @endslot
            @slot('parent') Главная @endslot
            @slot('active') Товары @endslot
        @endcomponent

        <hr>
            <a href="{{route('admin.products.import')}}" class="btn btn-success float-right "><i class="fas fa-plus-circle"></i>Имортировать с файла</a>
            <a href="{{route('admin.products.create')}}" class="btn btn-primary float-right mr-2"><i class="fa fa-plus-square-o"></i> Добавить товар вручную</a>



                        <div class="card mb-4 col-12">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Добавленые товары</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Название</th>
                                            <th>Категория</th>
                                            <th>Количество</th>
                                            <th>Статус</th>
                                            <th>Дата публ.</th>
                                            <th class="text-right">Изменить</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Название</th>
                                            <th>Категория</th>
                                            <th>Количество</th>
                                            <th>Статус</th>
                                            <th>Дата публ.</th>
                                            <th class="text-right">Изменить</th>
                                        </tr>

                                        <tr>
                                            <td colspan="3">
                                                <ul class="pagination pull-right">
                                                    @if(isset($products)) {{$products->links()}}  @endif
                                                </ul>
                                            </td>
                                        </tr>
                                        </tfoot>
                                        <tbody>

                                        @if(isset($products))
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td><a href="products/{{$product->id}}/edit">{{$product->name}}</a></td>

                                                    <td> {{$product->category_name}} </td>
                                                    <td> {{$product->count}} </td>
                                                    <td>
                                                        @if($product->published ==1) Опубликован
                                                        @else Не опубликован
                                                        @endif
                                                    </td>
                                                    <td> {{$product->created_at}}  </td>
                                                    <td>
                                                        <a href="products/{{$product->id}}/edit"><i class="fa fa-edit"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>






    </div>

@endsection
