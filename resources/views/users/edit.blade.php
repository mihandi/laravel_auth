@extends('layouts.app')

@section('content')

    <div class="container">
        <form class="form-horizontal" action="{{route('user.update', $user)}}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            @include('partials.form')

        </form>
    </div>
@endsection
