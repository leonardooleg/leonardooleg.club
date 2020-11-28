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



                    <div class="profile-message-btn center-block text-center">
                        <a href="#" class="btn btn-success">
                            <i class="fa fa-envelope"></i> Задать вопрос
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-md-8 col-sm-8">
                <div class="main-box clearfix">
                    <form class="form-horizontal" action="{{route('profile.update')}}" method="post"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="profile-header">
                            <h3><span>Редактировать профиль</span></h3>
                            <button type="submit" class="btn btn-primary edit-profile">
                                <i class="fa fa-pencil-square fa-lg"></i> Сохранить
                            </button>
                        </div>



                        <div class="tabs-wrapper profile-tabs">
                            <div class="tab-content">

                                <div class="accordion" id="accordionOrders">

                                    <label for=""><strong>Имя</strong></label>
                                    <input type="text" class="form-control" name="name" placeholder="Имя"
                                           value="@if(old('name')){{old('name')}}@else{{$user->name ?? ""}}@endif" required>

                                    <label for=""><strong>Email</strong></label>
                                    <input type="email" class="form-control" name="email" placeholder="Email"
                                           value="@if(old('email')){{old('email')}}@else{{$user->email ?? ""}}@endif" required>

                                    <label for=""><strong>Пароль</strong></label>
                                    <input type="password" class="form-control" name="password">
                                    <label for=""><strong>Пароль еще раз</strong></label>
                                    <input type="password" class="form-control" name="confirm-password">
<br>
<br>
                                    <label for=""><strong>Загрузить аватар</strong></label>
                                    <input type="file" name="avatar"
                                           class="custom-file-input">



                                </div>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
