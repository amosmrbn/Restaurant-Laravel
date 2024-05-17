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

<a href="{{ URL::to('menu/create') }}" class="btn btn btn-primary mb-3">
    <i class="fas fa-plus" aria-hidden="true"></i>
    Add
</a>
<table id="datatable1" class="table table-bordered table-striped ">
    <thead>
        <tr>
            <th style="width: 5%;">No</th>
            <th class="text-center">Image</th>
            <th class="text-center">Name</th>
            <th class="text-center">Category</th>
            <th class="text-center">Description</th>
            <th class="text-center">User</th>
            <th class="text-center">Price</th>
            <th class="text-center" style="width: 10%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($menus as $index => $menu)
        <tr>
            <td class="align-middle" style="text-align: center">{{ $index + 1}}</td>
            <td class="align-middle" style="text-align: center">
                <a onclick="showDetailImageModal('{{ URL::to('storage/'. $menu->image) }}')" class="btn btn-link" data-toggle="modal" data-target="#detailImageModal">
                    <img src="{{ URL::to('storage/'. $menu->image) }}" alt="Image" width="50%">
                </a>
            </td>
            <td class="align-middle">{{ $menu->name}}</td>
            <td class="align-middle">{{ $menu->category->name}}</td>
            <td class="align-middle">{{ $menu->description}}</td>
            <td class="align-middle">{{ $menu->user->name}}</td>
            {{-- Panggil function NumberFormat dari Helper untuk formating angka --}}
            <td class="text-right align-middle">{{ NumberFormat($menu->price) }}</td>
            <td class="align-middle">
                <div class="d-flex">
                    <a href="{{ URL::to('menu/' . $menu->id) }}" class="btn btn-sm btn-info mr-2">Show</a>
                    <a href="{{ URL::to('menu/' . $menu->id . '/edit') }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                    @if(auth()->user()->role === 'admin')
                    <form method="POST" action="{{ URL::to('menu/' . $menu->id) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin mau menghapus menu {{ $menu->name }} ?')">Delete</button>
                    </form>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="detailImageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
            <img id="modalDetailImage" src="" alt="Menu Image" style="max-width: 400px; max-height: 400px;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@endsection