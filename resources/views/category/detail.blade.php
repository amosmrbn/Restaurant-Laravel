@extends('layouts.main')
@section('container')

<div class="row">
    <div class="col-12">
        <a href="{{ URL::to('category/') }}" class="btn btn-sm" style="background-color: #343A40; color:antiquewhite">Back</a>
        <div class="form-group mt-3">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $category->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" class="form-control" value="{{ $category->description }}" readonly>
        </div>
        <div class="form-group">
            <label for="user">User</label>
            <input type="text" id="user" name="user" class="form-control" value="{{ $category->user->name }}" readonly>
        </div>
    </div>
</div>

@endsection