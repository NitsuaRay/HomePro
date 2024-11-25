<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PSU - Asingan Campus</title>

    <style>
        html {
            margin-top: 5px;
            margin-right: 2px;
            margin-left: 2px;
        }

        body {
            margin: 0 0 0 0;
            padding: 0 0 0 0;
            box-sizing: border-box;
            width: 100vw;
            font-size: 12px;
        }

        .date {
            display: flex;
            justify-content: end;
            margin: 0 10px 0 10px;
            padding: 0 0 0 0;
            width: 100vw;
            text-align: right;
        }

        h2 {
            text-align: center;
        }

        .mainCon {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
        }

        .con {
            width: 95%;
            margin: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .barCon {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>

</head>

<body>
    <header>
        <img src="{{ public_path('upload/headerPdf.png') }}" alt="Header Image" style="width: 100%;" />
    </header>

    <div class="date">
        <p>Date: {{ date('F j, Y') }}</p>
    </div>
    <h2>Bookings Report</h2>

    <div class="mainCon">
        <div class="con">
            <table>
                <thead>
                    <tr>
                        <th>Homwowner</th>
                        <th>Service Personnel</th>
                        <th>Service Category</th>
                        <th>Address</th>
                        <th>Work Details</th>
                        <th>Service Date</th>
                        <th>Payment Method</th>
                        <th>Fee/Extra Fee</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($booking as $bookings)
                    <tr>
                        <td>{{ $bookings->user->first_name }} {{ $bookings->user->last_name }}</td>
                        <td>{{ $bookings->personnel->first_name }} {{ $bookings->personnel->last_name }}</td>
                        <td>{{ $bookings->personnel->service_cat }} <br> Additional Skill: {{ $bookings->personnel->description }}</td>
                        <td>{{ $bookings->user->address }}</td>
                        <td>{{ $bookings->work_details }}</td>
                        <td>{{ \Carbon\Carbon::parse($bookings->service_date)->format('F d, Y') }}</td>
                        <td>{{ $bookings->payment_method }}</td>
                        <td>{{ $bookings->fee }} <br>{{ $bookings->fee }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">No items selected</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


</body>


</html>