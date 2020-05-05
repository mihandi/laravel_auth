@extends('layouts.app')

@section('content')

    <div class="container">
        <form class="form-horizontal" action="{{route('user.store')}}" method="post">
        {{ csrf_field() }}

        @include('partials.form')

        </form>
    </div>
@endsection
