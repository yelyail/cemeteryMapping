<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 30px;
            margin: 20px 0;
        }
        p {
            font-size: 16px;
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
<body>
<div class="container">
        <div class="header">
            <h1>{{ $title }}</h1>
            <p>Reference: {{ $reference }}</p>
            <p>Date: {{ $date }}</p>
        </div>
        <h1>Cemetery Information</h1>
        <table>
            <thead>
                <tr>
                    <th>Cemetery Name</th>
                    <th>Size</th>
                    <th>Total Plots</th>
                    <th>Price</th>
                    <th>Maintenance Fee</th>
                    <th>Establishment Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cemInfo as $cemInfos)
                    <tr>
                        <td>{{ ucwords(strtolower($cemInfos->cemName)) }}</td>
                        <td>{{ $cemInfos->size }}</td>
                        <td>{{ $cemInfos->plotTotal }}</td>
                        <td>₱{{ number_format($cemInfos->plotPrice, 2) }}</td>
                        <td>₱{{ number_format($cemInfos->plotMaintenanceFee, 2) }}</td>
                        <td>{{ $cemInfos->establishmentDate }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h1>Buyer Information</h1>
        <table>
            <thead>
                <tr>
                    <th>Buyer Name</th>
                    <th>Contact Number</th>
                    <th>Contact Email</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach($buyerInfo as $buyerInfos)
                    <tr>
                        <td>{{ ucwords(strtolower($buyerInfos->fullName)) }}</td>
                        <td>{{ $buyerInfos->contactNum }}</td>
                        <td>{{ $buyerInfos->email }}</td>
                        <td>{{ ucwords(strtolower($buyerInfos->address)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h1>Decease Information</h1>
        <table>
            <thead>
                <tr>
                    <th>Location</th>
                    <th>Fullname</th>
                    <th>Gender</th>
                    <th>Birth Date</th>
                    <th>Died Date</th>
                    <th>Burial Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deceaseInfo as $deceaseInfos)
                    <tr>
                        <td>{{ ucwords(strtolower($deceaseInfos->plotInvent->cemName)) }}, Plot Number: {{ $deceaseInfos->plotInvent->plotNum }}</td>
                        <td>{{ ucwords(strtolower($deceaseInfos->fullName)) }}</td>
                        <td>{{ ucwords(strtolower($deceaseInfos->gender)) }}</td>
                        <td>{{ $deceaseInfos->bornDate }}</td>
                        <td>{{ $deceaseInfos->diedDate }}</td>
                        <td>{{ $deceaseInfos->burialDate }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>