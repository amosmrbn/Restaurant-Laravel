@extends('layouts.main')
@section('container')

{{-- <div class="form-group mt-3"> --}}

    <a href="{{ URL::to('menu/') }}" class="btn btn-sm" style="background-color: #343A40; color:antiquewhite">Back</a>
{{-- </div> --}}
<div class="row">
    <div class="col-6">
        
        <div class="form-group mt-3">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $menu->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" id="category" name="category" class="form-control" value="{{ $menu->category->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" class="form-control" value="{{ $menu->description }}" readonly>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" class="form-control" value="{{ $menu->price }}" readonly>
        </div>
    </div>
    
    <div class="col-6 mt-3">
        <div class="form-group">
            <label for="user">User</label>
            <input type="text" id="user" name="user" class="form-control" value="{{ $menu->user->name }}" readonly>
        </div>
        <div class="form-group mt-3">
            <label for="image" class="form-label">Image</label>
            <div class="input-group">
                {{-- <input type="text" id="image" name="image" class="form-control" readonly>
                <div class="input-group-append">
                    
                    <span class="input-group-text">URL</span>
                </div> --}}
                <div class="mt-3 text-center">
                    <img src="{{ URL::to('storage/' . $menu->image) }}" alt="Gambar" class="img-fluid rounded" style="width: 30%; border: 1px solid #ddd; padding: 5px;">
                </div>
            </div>
        </div>

    </div>
</div>

@endsection