@extends('layouts.main')
@section('container')

@if(isset($category))
<form action="{{ URL::to('category/' . $category->id) }}" method="POST" autocomplete="off">
    @method('PUT')
@else
<form action="{{ URL::to('category') }}" method="POST" autocomplete="off">
@endif
    @csrf
    <div class="row">
        <div class="col-12">
            <a href="{{ URL::to('category/') }}" class="btn btn-sm" style="background-color: #343A40; color:antiquewhite">Back</a>
            <div class="form-group mt-3">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control @error('name')is-invalid @enderror" value="{{ isset($category)? $category->name : old('username') }}" placeholder="Masukkan nama">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control @error('description')is-invalid @enderror" value="{{ isset($category)? $category->description : old('username') }}" placeholder="Masukkan deskripsi">
                @error('description')
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