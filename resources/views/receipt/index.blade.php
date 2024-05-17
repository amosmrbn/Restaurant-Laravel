@extends('layouts.main')
@section('container')
@include('sweetalert::alert')

<a href="{{ URL::to('receipt/create') }}" class="btn btn btn-primary mb-3">
    <i class="fas fa-plus" aria-hidden="true"></i>
    Add
</a>
<table id="datatable1" class="table table-bordered table-striped ">
    <thead>
        <tr>
            <th style="width: 5%; text-align: center">No</th>
            <th style="text-align: center">Receipt Date</th>
            <th style="text-align: center">Customer Name</th>
            <th style="text-align: center">Description</th>
            <th style="text-align: center">User</th>
            <th style="width: 10%; text-align: center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($receipts as $index => $receipt)
        <tr>
            <td style="text-align: center">{{ $index + 1}}</td>
            <td>{{ DateFormat($receipt->receipt_date, "H:m:s | DD-MMMM-Y") }}</td>
            <td>{{ $receipt->customer_name}}</td>
            <td>{{ $receipt->description}}</td>
            <td>{{ $receipt->user->name}}</td>
            <td >
                <div class="d-flex">
                    <a href="{{ URL::to('receipt/' . $receipt->id) }}" class="btn btn-sm btn-info mr-2">Show</a>
                    <a href="{{ URL::to('receipt/' . $receipt->id . '/edit') }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                    <form method="POST" action="{{ URL::to('receipt/' . $receipt->id) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin mau menghapus receipt {{ $receipt->name }} ?')">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection