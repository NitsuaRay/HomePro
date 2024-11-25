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
    <h2>Personnel Report</h2>

    <div class="mainCon">
        <div class="con">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Emal</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Service Category</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personnel as $personnels)
                    <tr>
                        <td>{{ $personnels->first_name }} {{ $personnels->last_name }}</td>
                        <td>{{ $personnels->email }}</td>
                        <td>{{ $personnels->phone }}</td>
                        <td>{{ $personnels->gender }}</td>
                        <td>{{ $personnels->age }}</td>
                        <td>{{ $personnels->address }}</td>
                        <td>{{ $personnels->service_cat }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</body>


</html>