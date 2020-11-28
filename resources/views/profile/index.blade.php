@extends('layouts.app')


@section('title', 'Мой профиль')

@section('content')


    <div class="container bootstrap snippets">
        <div class="row" id="user-profile">
            <div class="col-lg-3 col-md-4 col-sm-4">
                <div class="main-box clearfix">
                    <h2>{{$user->name}} </h2>
                    <div class="profile-status">
                    </div>
                    @if(isset($user->avatar))
                        <img class="avatar profile-img img-responsive center-block"  src="/storage/{{$user->avatar}}" alt="image">
                    @else
                        <img class="avatar profile-img img-responsive center-block" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="image">
                    @endif



                  <div class="profile-since">
                      Зарегистрирован: <br> {{substr($user->created_at, 0, 10)}}
                    </div>

                    <div class="profile-details">
                        <ul class="fa-ul">
                            <li><i class="fa-li fa fa-truck"></i>Заказов: <span>{{$orders->count()}}</span></li>
                            <li><i class="fa-li fa fa-tasks"></i>Завершенных: <span>{{$orders->where('status', 10)->count()}}</span></li>
                        </ul>
                    </div>

                    <div class="profile-message-btn center-block text-center">
                        <a href="#" class="btn btn-success">
                            <i class="fa fa-envelope"></i> Задать вопрос
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-md-8 col-sm-8">
                <div class="main-box clearfix">
                    <div class="profile-header">
                        <h3><span>Заказы</span></h3>
                        <a href="/profile/edit" class="btn btn-primary edit-profile">
                            <i class="fa fa-pencil-square fa-lg"></i> Изменить профиль
                        </a>
                    </div>



                    <div class="tabs-wrapper profile-tabs">
                        <div class="tab-content">

                            <div class="accordion" id="accordionOrders">
                                @php($i=0)
                                    @foreach ($orders as $order)
                                    <div class="card">
                                        <div class="card-header" id="heading{{$order->id}}">
                                            <h2 class="mb-0 @if($order->status==10) status-f @endif">
                                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$order->id}}" aria-expanded="true" aria-controls="collapse{{$order->id}}">
                                                    <div class="row head">
                                                        <div class="col-md-2"> № {{$order->id}} </div>
                                                        <div class="col-md-3">{{$order->created_at}} </div>
                                                        <div class="col-md-4 text-right"> на {{$order->total_price}} руб.</div>
                                                        <div class="col-md-3 v-line"> {{$order->status_name}}</div>
                                                    </div>
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapse{{$order->id}}" class="collapse @if($i==0) show @endif" aria-labelledby="heading{{$order->id}}" data-parent="#accordionOrders">
                                            <div class="card-body">
                                                @foreach ($items[$i] as $item)
                                                    <div class=" row" >
                                                        <div class="col-md-2">
                                                            <img class="img_cart" src="{{$item['attributes']['img']}}" alt="preview" style="width: 100%">
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div  class=""> <b> {{$item['name']}} </b>   ({{$item['attributes']['vendor_code']}})</div>
                                                            <div  class=""> <b>Размер:</b> {{$item['attributes']['brand_name_size']}} ({{$item['attributes']['rus_name_size']}}) </div>
                                                            <div  class="">  <b>Цвет: </b>{{$item['attributes']['color_name']}}</div>
                                                            <div  class="">  <b>Стоимость: </b>{{$item['price']}} руб.</div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <span class="align-text-bottom">{{$item['quantity']}} шт.</span>
                                                        </div>
                                                        <div class="col-md-2">
                                                              <span class="align-bottom">{{$item['quantity'] * $item['price']}} руб.</span>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                @endforeach
                                                <div class="profile-order-g-i">
                                                    <div  class=""> <b>Способ оплаты: </b>{{$order->type_pay}}</div>
                                                    <div  class=""> <b>Ф.И.О.: </b>	{{$order->clientName}}</div>
                                                    <div  class=""> <b>Телефон </b>{{$order->clientTel}}</div>
                                                    <div  class=""> <b>Адресс доставки </b>	{{$order->clientAddress}}</div>
                                                    <div  class=""> <b>Email </b>	{{$order->clientEmail}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @php($i++)
                                @endforeach



                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
