@extends('layouts.main')
@section('container')

<div class="row">
    <div class="col-12">
        <a href="{{ URL::to('user/') }}" class="btn btn-sm" style="background-color: #343A40; color:antiquewhite">Back</a>
        <div class="form-group mt-3">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control" value="{{ $user->username }}" readonly>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <input type="text" id="role" name="role" class="form-control" value="{{ $user->role }}" readonly>
        </div>
    </div>
</div>

@endsection