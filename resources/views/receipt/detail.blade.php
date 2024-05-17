@extends('layouts.main')
@section('container')

<div class="row">
    <div class="col-12">
        <a href="{{ URL::to('receipt/') }}" class="btn btn-sm" style="background-color: #343A40; color:antiquewhite">Back</a>
        <div class="form-group mt-3">
            <label for="customer_name">Customer Name</label>
            <input type="text" id="customer_name" name="customer_name" class="form-control" value="{{ $receipt->customer_name }}" readonly>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" class="form-control" value="{{ $receipt->description }}" readonly>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" id="status" name="status" class="form-control" value="{{ $receipt->status }}" readonly>
        </div>
    </div>
</div>

@endsection