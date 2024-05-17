@extends('layouts.main')
@section('container')
@include('sweetalert::alert')

<form action="{{ URL::to('report') }}" method="GET">
    <div class="row">
        <div class="col-2">
            <div class="form-group">
                <label for="startDate">From:</label>
                <input type="date" id="startDate" name="startDate" class="form-control" value="{{ DateFormat($startDate, "DD-MM-Y") }}">               
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label for="endDate">To:</label>
                <input type="date" id="endDate" name="endDate" class="form-control" value="{{ DateFormat($endDate, "DD-MM-Y") }}">               
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Filter</button>
    <a href="{{ URL::to('report?startDate='. DateFormat($startDate, "Y-MM-DD") .'&endDate='. DateFormat($endDate, "Y-MM-DD") .'&print=true') }}" class="btn btn-info">Print</a>
</form>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th style="width: 5%; text-align: center">No</th>
            <th style="text-align: center">Receipt Date</th>
            <th style="text-align: center">Customer Name</th>
            <th style="text-align: center">Description</th>
            <th style="text-align: center">User</th>
        </tr>
    </thead>
    <tbody>
        @foreach($receipts as $index => $receipt)
        <tr>
            <td style="text-align: center">{{ $index + 1}}</td>
            <td>{{ DateFormat($receipt->receipt_date, "H:m:s | DD MMMM Y") }}</td>
            <td>{{ $receipt->customer_name}}</td>
            <td>{{ $receipt->description}}</td>
            <td>{{ $receipt->user->name}}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="3"> 
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 5%; text-align: center">No</th>
                        <th style="text-align: center">Menu</th>
                        <th style="text-align: center">Amount</th>
                        <th style="text-align: center">Price</th>
                        <th style="text-align: center">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $total = 0;    
                    ?>
                    @foreach($receipt->receiptDetails as $index => $receiptDetail)
                    <tr>
                        <td class="align-middle" style="text-align: center">{{ $index + 1 }}</td>
                        <td class="align-middle">{{ $receiptDetail->menu->name }}</td>
                        <td class="text-right align-middle">{{ $receiptDetail->amount }}</td>
                        <td class="text-right align-middle">{{ number_format($receiptDetail->price, 0, ',', '.') }}</td>
                        <td class="text-right align-middle">{{ number_format($receiptDetail->menu->price * $receiptDetail->amount, 0, ',', '.') }}
                            <?php
                                $total += $receiptDetail->menu->price * $receiptDetail->amount;    
                            ?>
                        </td>
                    </tr>
                    @endforeach
                    <tr class="font-weight-bold">
                        <td colspan="4" class="text-center ">Total</td>
                        <td class="text-right">{{ NumberFormat($total) }}</td>
                    </tr>
                </tbody>
            </table>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection