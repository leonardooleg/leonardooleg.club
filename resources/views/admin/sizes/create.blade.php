@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Добавить размер @endslot
            @slot('parent') Главная @endslot
            @slot('active') Размеры @endslot
        @endcomponent

        <hr/>

        <form class="form-horizontal" action="{{route('admin.sizes.store')}}" method="post">
            {{ csrf_field() }}

            {{-- Form include --}}
            @include('admin.sizes.partials.form')

        </form>
    </div>

@endsection
