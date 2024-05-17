@extends('layouts.main')
@section('container')
@include('sweetalert::alert')

{{-- @if(session()->has("successMessage"))
    <div class="alert alert-success">
        {{ session("successMessage") }}
    </div>
@endif

@if(session()->has("errorMessage"))
    <div class="alert alert-danger">
        {{ session("errorMessage") }}
    </div>
@endif --}}

<a href="{{ URL::to('category/create') }}" class="btn btn btn-primary mb-3">
    <i class="fas fa-plus" aria-hidden="true"></i>
    Add
</a>
<table id="datatable1" class="table table-bordered table-striped ">
    <thead>
        <tr>
            <th style="width: 5%; text-align: center">No</th>
            <th style="text-align: center">Name</th>
            <th style="text-align: center">Description</th>
            <th style="text-align: center">User</th>
            <th style="width: 10%; text-align: center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $index => $category)
        <tr>
            <td style="text-align: center">{{ $index + 1}}</td>
            <td>{{ $category->name}}</td>
            <td>{{ $category->description}}</td>
            <td>{{ $category->user->name}}</td>
            <td >
                <div class="d-flex">
                    <a href="{{ URL::to('category/' . $category->id) }}" class="btn btn-sm btn-info mr-2">Show</a>
                    <a href="{{ URL::to('category/' . $category->id . '/edit') }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                    <form method="POST" action="{{ URL::to('category/' . $category->id) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin mau menghapus category {{ $category->name }} ?')">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection