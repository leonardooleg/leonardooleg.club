@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">


        @component('admin.components.breadcrumb')
            @slot('title') Список пользователей @endslot
            @slot('parent') Главная @endslot
            @slot('active') Пользователи @endslot
        @endcomponent

        <hr>

        <a href="{{route('admin.user_managment.user.create')}}" class="btn btn-primary float-right"><i
                class="fa fa-plus-square-o"></i> Создать пользователя</a>
        <table class="table table-striped">
            <thead>
            <th>Имя</th>
            <th>Email</th>
            <th>Роль</th>

            <th class="text-right">Изменить</th>
            </thead>
            <tbody>
            @forelse ($users as $user)
                <tr>
                    <td><a href="{{route('admin.user_managment.user.edit', $user)}}">{{$user->name}}</a></td>
                    <td>{{ $user->email}}</td>
                    <td>
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info" href="{{ route('admin.user_managment.user.show',$user->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{route('admin.user_managment.user.edit', $user)}}"><i
                                class="fa fa-edit"></i></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">
                    <ul class="pagination pull-right">
                        {{$users->links()}}
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection
