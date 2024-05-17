@extends('layouts.main')
@section('container')

@if(isset($menu))
<form action="{{ URL::to('menu/' . $menu->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
    @method('PUT')
@else
<form action="{{ URL::to('menu') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
@endif
    @csrf
    <a href="{{ URL::to('menu/') }}" class="btn btn btn-dark" ><i class="fas fa-backward mr-2"></i>Back</a>
    <div class="row">
        <div class="col-6">
            <div class="form-group mt-3">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control @error('name')is-invalid @enderror" value="{{ isset($menu)? $menu->name : "" }}" placeholder="Masukkan nama">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach ($categories as $category) 
                        <option value="{{ $category->id }}" {{ isset($menu) ? ($menu->category_id === $category->id ? 'selected' : '') : "" }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control @error('description')is-invalid @enderror" value="{{ isset($menu)? $menu->description : "" }}" placeholder="Masukkan deskripsi">
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="col-6 mt-3">
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" class="form-control @error('price')is-invalid @enderror" value="{{ isset($menu)? $menu->price : "" }}" placeholder="Masukkan harga">
                @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" class="form-control @error('image')is-invalid @enderror" value="{{ isset($menu)? $menu->image : "" }}" >
                @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

                @if(isset($menu))
                    <img src="{{ URL::to('storage/' . $menu->image) }}" alt="image" width="20%">
                @endif
            </div>
            
        </div>
            <button class="btn btn-primary btn-block" type="submit">Save</button>

    </div>
</form>

@endsection