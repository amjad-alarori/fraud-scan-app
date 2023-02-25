@include('includes.header')
@extends('layouts.app')
@section('content')
<div class="flex items-center justify-center w-screen">
    <table class="border-separate border-spacing-y-2 text-sm">
        <thead class="bg-gray-100 w-screen">
        <tr class="w-screen">
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">BSN</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">First Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date of Birth</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tag</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP Address</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IBAN</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sort Fraud</th>
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
                            @case('c')
                                <span class="inline-block rounded-md bg-orange-600/50 px-2 py-1 text-xs font-semibold uppercase text-orange-900 antialiased w-32">Under Age</span>
                                @break
                    @endswitch
                    @endif
                    @if(!isset($customer['fraud']))
                        <span class="inline-block rounded-md bg-green-600/50 px-2 py-1 text-xs font-semibold uppercase text-green-100 antialiased w-32">No Fraud</span>
                    @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop
