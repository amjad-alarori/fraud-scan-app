<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Fraud scan App</title>

    </head>
    <body class="">
    <p>This is my page</p>
    <td><button onclick="location.href='{{ url('customers') }}'">Check Customers</button></td>
    </body>
</html>
