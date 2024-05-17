@extends('layouts.main')
@section('container')

@if(isset($user))
<form action="{{ URL::to('user/' . $user->id) }}" method="POST" autocomplete="off">
    @method('PUT')
@else
<form action="{{ URL::to('user') }}" method="POST" autocomplete="off">
@endif
    @csrf
    <div class="row">
        <div class="col-12">
            <a href="{{ URL::to('user/') }}" class="btn btn-sm" style="background-color: #343A40; color:antiquewhite">Back</a>
            <div class="form-group mt-3">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control @error('name')is-invalid @enderror" value="{{ isset($user)? $user->name : old('name') }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control @error('username')is-invalid @enderror" value="{{ isset($user)? $user->username : old('username') }}">
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control @error('password')is-invalid @enderror">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select type="text" id="role" name="role" class="form-control @error('role') is-invalid @enderror">
                    <option value="">-- Pilih Role --</option>
                    <option value="user" {{ isset($user) && $user->role === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ isset($user) && $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button class="btn btn-primary btn-block" type="submit">Save</button>
            <a href=""></a>
        </div>
    </div>
</form>

@endsection