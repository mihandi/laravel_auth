@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('user.create')}}" class="btn btn-primary pull-right">
            <i class="fa fa-plus-square-o"></i> Create User
        </a>

        <table class="table table-striped" id="datatable">
            <thead>
            <th class="sorting" data-sort_type="asc" data-column_name="id">
                User Id <i id="id_icon" class="fa fa-sort-alpha-asc active"></i>
            </th>
            <th class="sorting" data-sort_type="asc" data-column_name="name">
                User Name <i id="name_icon" class="fa fa-sort-alpha-asc"></i>
            </th>
            <th class="sorting" data-sort_type="asc" data-column_name="email">
                Email <i id="email_icon" class="fa fa-sort-alpha-asc"></i>
            </th>
            <th class="text-right">Actions</th>
            <tr>
                <td>
                    <input type="text" class="form-control filter-input" data-column="id">
                </td>
                <td>
                    <input type="text" class="form-control filter-input" data-column="name">
                </td>
                <td>
                    <input type="text" class="form-control filter-input" data-column="email">
                </td>
                <td>
                    <input type="text" class="form-control filter-input" data-column="roles">
                </td>
            </tr>
            </thead>

            <tbody>
            @include('partials.user_table')
            </tbody>
        </table>

        <input type="hidden" name="sort_column_name" id="sort_column_name" value="id">
        <input type="hidden" name="sort_type" id="sort_type" value="asc">
    </div>

@endsection

<script src="{{ asset('js/users.js') }}" defer></script>
