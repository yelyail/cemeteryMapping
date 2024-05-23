<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
</head>
<style>
h1{
    font-size: 35px; margin: left 30%;
}
p{
    text-align: left;
    font-size: 20px;
    font-weight: bold;
}
table{
    width: 100%;
    border: 2px solid #544f43;
}
th{
    border: 2px solid #544f43;
    width: 16.5%;
    text-align: center;
    font-weight: bold;
    font-size: 15px;
}
td{
    text-align: center;
    font-weight: light;
    font-size: 12px;
}
</style>
<body>
    <h1>{{ $title }}</h1>
    <p>Buyer Name: {{ ucwords(strtolower($deceased->plotInvent->buyer->fullName ?? 'N/A')) }}</p>
    <p>Reference: {{ $reference }}</p>
    <p>Date: {{ $date }}</p>
    <table>
        <thead>
            <tr>
                <th>Deceased Name</th>
                <th>Location</th>
                <th>Purchase Date</th>
                <th>Date of Transfer</th>
                <th>Reason to Transfer</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ ucwords(strtolower($deceased->firstName ?? 'N/A')) }}
                    {{ $deceased->middleName ? ucwords(strtolower(substr($deceased->middleName, 0, 1))) . '.' : '' }}
                    {{ ucwords(strtolower($deceased->lastName ?? 'N/A')) }}
                </td>
                <td>{{ ucwords(strtolower($deceased->plotInvent->cemName ?? 'N/A')) }}, Plot Number: {{ $deceased->plotInvent->plotNum ?? 'N/A' }}</td>
                <td>{{ $deceased->plotInvent->purchaseDate ?? 'N/A' }}</td>
                <td>{{ $deceased->updated_at ?? 'N/A' }}</td>
                <td>{{ ucwords(strtolower($deceased->reason ?? 'N/A')) }}</td>
                <td>{{ ucwords(strtolower($deceased->remarks ?? 'N/A')) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>