<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>
<body>

    <h4 class="text-center"> Receipt Report {{ DateFormat($startDate, "DD MMMM Y") }} - {{ DateFormat($endDate, "DD MMMM Y") }}</h4>
    <br><br>
    <table class="table table-bordered table-striped mt-3">
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
                <td>{{ DateFormat($receipt->receipt_date, 'H:m:s | DD-MMMM-Y') }}</td>
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
    
</body>
</html>