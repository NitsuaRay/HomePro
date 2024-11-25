<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PSU - Asingan Campus</title>

    <style>
        html {
            margin-top: 3px;
            margin-right: 2px;
            margin-left: 2px;
            margin-bottom: 0;
        }

        body {
            margin: 0 0 0 0;
            padding: 0 0 0 0;
            box-sizing: border-box;
            width: 100vw;
            height: 100vh;
            font-size: 10px;
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
            margin: 0;
            text-align: center;
        }

        .mainCon {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
        }

        .con {
            width: 96%;
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
            padding: 5px;
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

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding: 0 0 0 0;
        }

        main {
            flex: 1;
            padding-bottom: 90px;
            /* Adjust this value to your footer's height */
        }

        footer {
            padding: 0 0 0 0;
            margin: 0 0 0 0;
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 50px;
        }
    </style>

</head>

<body>
    <div class="wrapper">

        <header>
            <img src="{{ public_path('upload/headerPdf.png') }}" alt="Header Image" style="width: 100%;" />
        </header>

        <div class="date">
            <p style="font-size: 14px;">{{ date('F j, Y') }}</p>
        </div>
        <h2>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} Booking Report</h2>
        <main>
            <div class="mainCon">
                <div class="con">
                    <table>
                        <thead>
                            <tr>=
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
                            <tr>
                                <td>{{ $booking->personnel->first_name }} {{ $booking->personnel->last_name }}</td>
                                <td>{{ $booking->personnel->service_cat }}</td>
                                <td>{{ $booking->user->address }}</td>
                                <td>{{ $booking->work_details }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->service_date)->format('F d, Y h:i A') }}</td>
                                <td>{{ $booking->payment_method }}</td>
                                <td>{{ $booking->fee }} <br>{{ $booking->extra_fee }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        <footer>
            <img src="{{ public_path('upload/footer.png') }}" alt="Header Image" style="width: 100%;" />
        </footer>
    </div>
</body>


</html>
