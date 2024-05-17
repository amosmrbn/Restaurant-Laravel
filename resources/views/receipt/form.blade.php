@extends('layouts.main')
@section('container')
@include('sweetalert::alert')

@if(isset($receipt))
<form action="{{ URL::to('receipt/' . $receipt->id) }}" method="POST" autocomplete="off">
    @method('PUT')
@else
<form action="{{ URL::to('receipt') }}" method="POST" autocomplete="off">
@endif
    @csrf
    <div class="row">
        <div class="col-12">
            <a href="{{ URL::to('receipt/') }}" class="btn btn-sm" style="background-color: #343A40; color:antiquewhite">Back</a>
            <div class="form-group mt-3">
                <label for="customer_name">Customer Name</label>
                <input type="text" id="customer_name" name="customer_name" class="form-control @error('customer_name')is-invalid @enderror" value="{{ isset($receipt)? $receipt->customer_name : old('username') }}" placeholder="Masukkan nama">
                @error('customer_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control @error('description')is-invalid @enderror" value="{{ isset($receipt)? $receipt->description : old('username') }}" placeholder="Masukkan deskripsi">
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select type="text" id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="">-- Pilih Status --</option>
                    <option value="entry" {{ isset($receipt) && $receipt->status === 'entry' ? 'selected' : '' }}>Entry</option>
                    <option value="done" {{ isset($receipt) && $receipt->status === 'done' ? 'selected' : '' }}>Done</option>
                </select>
                @error('status')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            
            <button class="btn btn-primary btn-block" type="submit">Save</button>
        </div>
    </div>
</form>

@if(isset($receipt))
<hr>
<h2 class="text-center">Receipt Details</h2>

<div class="row">
    <div class="col-md-5 border ">
        <div class="row">
            {{-- @foreach($menus as $menu)
            <div class="col-md-4 mb-4 d-flex align-items-stretch mt-2">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="{{ asset('storage/' . $menu->image) }}" alt="Image Menu">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $menu->name }}</h5>
                        <form action="{{ URL::to('receipt-detail') }}" method="POST" autocomplete="off" class="mt-auto">
                            @csrf
                            <input type="hidden" name="receipt_id" value="{{ $receipt->id }}">
                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                            <div class="form-group">
                                <input type="number" name="amount" class="form-control" value="1">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Select</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach --}}
            @foreach($menus as $menu)
            <div class="col-md-4 mb-4 d-flex align-items-stretch mt-2">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top card-img-fixed" src="{{ asset('storage/' . $menu->image) }}" alt="Image Menu">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $menu->name }}</h5>
                        <form action="{{ URL::to('receipt-detail') }}" method="POST" autocomplete="off" class="mt-auto">
                            @csrf
                            <input type="hidden" name="receipt_id" value="{{ $receipt->id }}">
                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                            <div class="form-group">
                                <input type="number" name="amount" class="form-control" value="1">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Select</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="col-md-7 border ">
        <table class="table table-bordered table-striped mt-2 table-responsive">
            <thead>
                <tr>
                    <th style="width: 5%; text-align: center">No</th>
                    <th style="text-align: center">Category</th>
                    <th style="text-align: center">Menu</th>
                    <th style="text-align: center">Amount</th>
                    <th style="text-align: center">Price</th>
                    <th style="text-align: center">Subtotal</th>
                    <th style="width: 10%; text-align: center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $total = 0;    
                ?>
                @foreach($receipt->receiptDetails as $index => $receiptDetail)
                <tr>
                    <td class="align-middle" style="text-align: center">{{ $index + 1 }}</td>
                    <td class="align-middle">{{ $receiptDetail->menu->category->name }}</td>
                    <td class="align-middle">{{ $receiptDetail->menu->name }}</td>
                    <td class="text-right align-middle">{{ $receiptDetail->amount }}</td>
                    <td class="text-right align-middle">{{ number_format($receiptDetail->price, 0, ',', '.') }}</td>
                    <td class="text-right align-middle">{{ number_format($receiptDetail->menu->price * $receiptDetail->amount, 0, ',', '.') }}
                        <?php
                            $total += $receiptDetail->menu->price * $receiptDetail->amount;    
                        ?>
                    </td>
                    <td class="align-middle">
                        <div class="d-flex align-middle">
                            <a href="{{ URL::to('receipt/' . $receiptDetail->id . '/edit') }}" class="btn btn-sm btn-warning mr-2 align-middle ">Edit</a>

                            <form method="POST" action="{{ route('receipt-detail.destroy', $receiptDetail->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin mau menghapus receipt detail untuk menu {{ $receiptDetail->menu->name }}?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                <tr class="font-weight-bold">
                    <td colspan="5" class="text-center ">Total</td>
                    <td class="text-right">{{ NumberFormat($total) }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection