@extends('admin.layouts.app_admin')

@section('content')

    <div class="container-fluid">

        @component('admin.components.breadcrumb')
            @slot('title') Добавить товар @endslot
            @slot('parent') Главная @endslot
            @slot('active') Товары @endslot
        @endcomponent

        <hr/>

        <form class="form-horizontal" action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            {{-- Form include --}}
            @include('admin.products.partials.form')

            <button type="submit" class="btn btn-primary float-right">Добавить</button>

        </form>
    </div>

@endsection
