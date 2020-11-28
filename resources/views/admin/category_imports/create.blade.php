@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Создание редиректа категорий для импорта @endslot
            @slot('parent') Главная @endslot
            @slot('active') редирект категории @endslot
        @endcomponent

        <hr />

        <form class="form-horizontal" action="{{route('admin.category-import.store')}}" method="post">
            {{ csrf_field() }}

            {{-- Form include --}}
            @include('admin.category_imports.partials.form')

        </form>
    </div>

@endsection
