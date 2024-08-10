<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category</title>
    <style>
        h4,
        h2 {
            font-family: serif;
        }

        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .container {
            padding: 20px;
        }

        br {
            margin-bottom: 5px !important;
        }

        .judul {
            text-align: center;
        }

        .header {
            margin-bottom: 0px;
            text-align: center;
            height: 70px;
            padding: 0px;
        }

        .pemko {
            width: 80px;
        }

        .logo {
            float: left;
            margin-right: 0px;
            width: 18%;
            padding: 2px;
            text-align: right;
        }

        .headtext {
            float: right;
            margin-left: 0px;
            width: 72%;
            padding-left: 0px;
            padding-right: 10%;
        }

        hr {
            margin-top: 10%;
            height: 3px;
            background-color: black;
            width: 100%;
        }

        .ttd {
            margin-left: 65%;
            text-align: center;
            text-transform: uppercase;
        }

        .text-right {
            text-align: right;
        }

        .isi {
            padding: 10px;
        }
        .w-10{
            width: 10%;
        }
        .w-20{
            width: 20%;
        }
        .w-40{
            width: 40%;
        }
        .w-50{
            width: 50%;
        }
    </style>
</head>

<body>
    <div class="header">
    <div class="logo" style="margin-right: 30px; margin-top: -25px; padding: 0;">
        <img class="pemko" src="https://i.imgur.com/Fs00trU.png" style="width: 120px;">
    </div>
    <div class="headtext">
        <h3 style="margin: 0px;">Budi Store </h3>
        <p style="margin: 0px;">Jalan Jauh Banget</p>
        <p style="margin: 0px;">Telp. 0823 2345 2793</p>
    </div>
</div>
    <div class="container">
        <hr style="margin-top:1px;">
        <div class="isi">
            <h2 style="text-align:center;">LAPORAN CATEGORY</h2>
            <table>
            <thead>
                <tr>
                    <th style="text-align:center;" class="w-10">ID</th>
                    <th style="text-align:center;" class="w-40">Name</th>
                    <th style="text-align:center;" class="w-40">Slug</th>
                    <th style="text-align:center;" class="w-20">Status</th>
                    <th style="text-align:center;" class="w-40">Show On Home</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['categories'] as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td >{{$category->name}}</td>
                    <td>{{$category->slug}}</td>
                    <td style="text-align:center;">
                        @if ($category->status == 1)
                        Active
                        @else
                        Inactive
                        @endif
                    </td>
                    <td style="text-align:center;">{{$category->showHome}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
            <br>
            <br>
            <br>
            <div class="ttd">
                <p style="margin:0px"> Denpasar, {{ $data['now'] }}</p>
                <h6 style="margin:0px">Budi Store</h6>
                <br>
                <br>
                <br>
                <br>
                <h5 style="text-decoration:underline; margin:0px">Bapak Budi Sentosa</h5>
                {{-- <h5 style="margin:0px">NIP. 19710830 199101 1 002</h5> --}}
            </div>
        </div>
    </div>
</body>

</html>
