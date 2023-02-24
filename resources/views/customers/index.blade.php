@extends('layouts.app')
@section('content')

<table>
    <thead>
    <tr>
        <th>Customer ID</th>
        <th>BSN</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date of Birth</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Tag</th>
        <th>Ip Address</th>
        <th>IBAN</th>
        <th>Last Invoice Date</th>
        <th>Last Login DateTime</th>
        <th>Sort Fraud</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($customers as $customer)
        <tr @if(isset($customer['fraud'])) class="fraud" @endif>
            <td>{{ $customer['customerId'] }}</td>
            <td>{{ $customer['bsn'] }}</td>
            <td>{{ $customer['firstName'] }}</td>
            <td>{{ $customer['lastName'] }}</td>
            <td>{{ $customer['dateOfBirth'] }}</td>
            <td>{{ $customer['phoneNumber'] }}</td>
            <td>{{ $customer['email'] }}</td>
            <td>{{ $customer['tag'] }}</td>
            <td>{{ $customer['ipAddress'] }}</td>
            <td>{{ $customer['iban'] }}</td>
            <td>{{ $customer['lastInvoiceDate'] }}</td>
            <td>{{ $customer['lastLoginDateTime'] }}</td>
            <td>@if(isset($customer['fraud'])) {{ $customer['fraud'] }} @endif</td>
        </tr>
    @endforeach

</table>

@stop
