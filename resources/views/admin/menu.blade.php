@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Управление меню @endslot
            @slot('parent') Главная @endslot
            @slot('active') Меню @endslot
        @endcomponent

        <hr>
            {!! Menu::render() !!}
    </div>

@endsection


