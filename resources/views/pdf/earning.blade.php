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
        <h2>{{ Auth::guard('personnel')->user()->first_name }} Bookings Earnings Per User Report</h2>
        <main>
            <div class="mainCon">
                <div class="con">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col" class="px-4 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    Address
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    Service Category
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    Service Date
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    Total Fee
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    Total Extra Fee
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($personnelBookings as $booking)
                            <tr>
                                <td class="px-6 py-4">
                                    {{ $booking->user->first_name }} {{ $booking->user->last_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $booking->user->address }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ Auth::guard('personnel')->user()->service_cat }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($booking->service_date)->format('F d, Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span style="font-family: DejaVu Sans;">&#8369;</span>{{ $booking->fee }}
                                </td>
                                <td class="px-6 py-4">
                                    <span style="font-family: DejaVu Sans;">&#8369;</span>{{ $booking->extra_fee }}
                                </td>
                            </tr>
                            @endforeach
                            <tr class="bg-white border-b">
                                <td colspan="4" class="px-6 py-4" style="font-weight: bold;">Total</td>
                                <td colspan="1" class="px-6 py-4">
                                    <span style="font-family: DejaVu Sans;">&#8369;</span>{{ $totalFee }}
                                </td>
                                <td colspan="1" class="px-6 py-4">
                                    <span style="font-family: DejaVu Sans;">&#8369;</span>{{ $totalExtraFee  }}
                                </td>
                            </tr>
                            <tr class="bg-gray-100 border-b">
                                <td colspan="5" class="px-6 py-4" style="font-weight: bold;">Grand Total</td>
                                <td colspan="1" class="px-6 py-4">
                                    <span style="font-family: DejaVu Sans;">&#8369;</span>{{ $grandTotal   }}
                                </td>
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