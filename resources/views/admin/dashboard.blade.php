@extends('admin.layouts.app_admin')

@section('content')

    <div class="container-fluid">


        <h1 class="">Dashboard</h1>
        <div class="row text-center">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4 ">
                    <div class="card-body">Созданых корзин</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link ">{{$orders->count()}}</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Проверенные заказы</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" >{{$orders->where('status', '>', 1)->count()}}</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Завершенных заказов</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" >{{$orders->where('status', '=', 10)->count()}}</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Отмененных заказов</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" >{{$orders->where('status', '=', 12)->count()}}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Заказы за {{$month_arr}}</div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Заказы за год</div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Последние заказы</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Покупатель</th>
                            <th>Сумма</th>
                            <th>Статус</th>
                            <th class="text-right">Изменить</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Покупатель</th>
                            <th>Сумма</th>
                            <th>Статус</th>
                            <th class="text-right">Изменить</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @forelse ($orders->sortByDesc('id') as $order)
                            <tr>
                                <td>  <a href="{{route('admin.orders.edit', $order)}}">{{$order->clientName}}</a></td>
                                <td>
                                    {{$order->total_price}} руб.
                                </td>
                                <td>
                                    @foreach($statuses as $status)
                                        @if($order->status==$status->id){{$status->status_name}} @break
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-right">
                                    <a  href="{{route('admin.orders.edit', $order)}}"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


</div>

@endsection

