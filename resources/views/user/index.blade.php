@extends('layouts.main')
@section('container')
@include('sweetalert::alert')

@if(session()->has("successMessage"))
    <div class="alert alert-success">
        {{ session("successMessage") }}
    </div>
@endif

@if(session()->has("errorMessage"))
    <div class="alert alert-danger">
        {{ session("errorMessage") }}
    </div>
@endif

<a href="{{ URL::to('user/create') }}" class="btn btn btn-primary mb-3">
    <i class="fas fa-plus" aria-hidden="true"></i>
    Add
</a>
<table id="datatable1" class="table table-bordered table-striped ">
    <thead>
        <tr>
            <th style="width: 5%; text-align: center">No</th>
            <th style="text-align: center">Name</th>
            <th style="text-align: center">Username</th>
            <th style="text-align: center">Role</th>
            <th style="width: 10%; text-align: center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $index => $user)
        <tr>
            <td style="text-align: center">{{ $index + 1}}</td>
            <td>{{ $user->name}}</td>
            <td>{{ $user->username}}</td>
            <td>{{ $user->role}}</td>
            <td >
                <div class="d-flex">
                    <a href="{{ URL::to('user/' . $user->id) }}" class="btn btn-sm btn-info mr-2">Show</a>
                    <a href="{{ URL::to('user/' . $user->id . '/edit') }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                    <form method="POST" action="{{ URL::to('user/' . $user->id) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin mau menghapus user {{ $user->name }} ?')">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection