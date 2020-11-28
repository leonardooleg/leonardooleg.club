@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Список пользователей @endslot
            @slot('parent') Главная @endslot
            @slot('active') Пользователи @endslot
        @endcomponent

        <hr>

        <a href="{{route('admin.user_managment.roles.create')}}" class="btn btn-primary float-right"><i
                class="fa fa-plus-square-o"></i> Создать роль для пользователей</a>
        <table class="table table-striped">
            <thead>
            <th>No</th>
            <th>Name</th>
            <th class="text-right" width="280px">Изменить</th>
            </thead>
            <tbody>
            @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        @can('role-edit')
                            <a class="btn btn-primary" href="{{ route('admin.user_managment.roles.edit',$role->id) }}">Edit</a>
                        @endcan
                        @can('role-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['admin.user_managment.roles.destroy', $role->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">
                    <ul class="pagination pull-right">
                        {{$roles->links()}}
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>
        {!! $roles->render() !!}
    </div>

@endsection
