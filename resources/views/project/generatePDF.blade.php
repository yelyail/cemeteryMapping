<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}"> 

</head>
<body>
    <h1>{{ $title }}</h1>
    <h2>Date: {{ $date }}</h2>
    <h3>Reference #: {{ $reference }}</h3>

    <table class="table-bordered">
        <thead>
            <tr>
                <th>Purchased by</th>
                <th>Decease Name</th>
                <th>Location</th>
                <th>Date of Purchase</th>
                <th>Date of Transfer</th>
                <th>Reason of Transfer</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deceased as $decease)
                <tr>
                    <td>{{ ucwords(strtolower($decease->plotInvent->buyer->fullName)) }}</td>
                    <td>{{ ucwords(strtolower($decease->firstName)) }}
                        {{ ucwords(strtolower($decease->middleName)) ? ucwords(strtolower(substr($decease->middleName, 0, 1))) . '.' : '' }}
                        {{ ucwords(strtolower($decease->lastName)) }}
                    </td>                                    
                    <td>{{ ucwords(strtolower($decease->plotInvent->cemName)) }}, Plot Number: {{ $decease->plotInvent->plotNum }}</td>
                    <td>{{ $decease->plotInvent->purchaseDate }}</td>
                    <td>{{ $decease->updated_at }}</td>
                    <td>{{ ucwords(strtolower($decease->reason)) }}</td>
                    <td>{{ ucwords(strtolower($decease->remarks)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>