@include('includes.header')
@extends('layouts.app')
@section('content')
<div class="flex items-center justify-center w-screen">
    <table class="border-separate border-spacing-y-2 text-sm">
        <thead class="sr-only">
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
            <th>Sort Fraud</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($customers as $customer)
            <tr @if(isset($customer['fraud'])) class="tr" @endif>
                <td class="td">{{ $customer['customerId'] }}</td>
                <td class="td">{{ $customer['bsn'] }}</td>
                <td class="td">{{ $customer['firstName'] }}</td>
                <td class="td">{{ $customer['lastName'] }}</td>
                <td class="td">{{ $customer['dateOfBirth'] }}</td>
                <td class="td">{{ $customer['phoneNumber'] }}</td>
                <td class="td">{{ $customer['email'] }}</td>
                <td class="td">{{ $customer['tag'] }}</td>
                <td class="td">{{ $customer['ipAddress'] }}</td>
                <td class="td">{{ $customer['iban'] }}</td>
                <td class="td">@if(isset($customer['fraud']))
                        @switch($customer['fraud'])
                        @case('IBAN Fraud')
                            <span class="inline-block rounded-md bg-red-600/50 px-2 py-1 text-xs font-semibold uppercase text-red-900 antialiased w-32">IBAN Fraud</span>
                            @break
                        @case('Outside the Netherlands')
                            <span class="inline-block rounded-md bg-gray-600/50 px-2 py-1 text-xs font-semibold uppercase text-gray-900 antialiased w-32">Not In NL</span>
                            @break
                        @case('IP Address Fraud')
                            <span class="inline-block rounded-md bg-yellow-600/50 px-2 py-1 text-xs font-semibold uppercase text-yellow-900 antialiased w-32">IP Fraud</span>
                            @break
                        @default
                            <span class="inline-block rounded-md bg-green-600/50 px-2 py-1 text-xs font-semibold uppercase text-green-100 antialiased w-32">No Fraud</span>
                    @endswitch
                    @endif</td>
                <td class="td">

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop
