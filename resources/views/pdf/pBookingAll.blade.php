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
            <p>Date: {{ date('F j, Y') }}</p>
        </div>
        <h2>{{ Auth::guard('personnel')->user()->first_name }} Bookings Report</h2>
        <main>

            <div class="mainCon">
                <div class="con">
                    <table>
                        <thead>
                            <tr>
                                <th>Service Category</th>
                                <th>Homwowner</th>
                                <th>Address</th>
                                <th>Work Details</th>
                                <th>Service Date</th>
                                <th>Payment Method</th>
                                <th>Fee/Extra Fee</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($booking as $bookings)

                            <tr>
                                <td>{{ $bookings->personnel->service_cat }}</td>
                                <td>{{ $bookings->user->first_name }} {{ $bookings->user->last_name }}</td>
                                <td>{{ $bookings->user->address }}</td>
                                <td>{{ $bookings->work_details }}</td>
                                <td>{{ \Carbon\Carbon::parse($bookings->service_date)->format('F d, Y') }}</td>
                                <td>{{ $bookings->payment_method }}</td>
                                <td>{{ $bookings->fee }} <br>{{ $bookings->fee }}</td>
                            </tr>

                            @endforeach
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