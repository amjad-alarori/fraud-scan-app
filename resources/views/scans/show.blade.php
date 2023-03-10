@extends('layouts.app')
@include('includes.header')
@section('content')
<br>
<div class="flex items-center justify-center">
    <span class=" bg-blue-100 text-blue-800 text-2xl font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-2">{{ $scan->created_at }}</span></h1>
</div>

<div class="flex items-center justify-center">
    <table class="border-separate border-spacing-y-2 text-sm">
        <thead class="sr-only">
        <tr>
            <th>Customer ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date Of Birth</th>
            <th>Phone number</th>
            <th>Ip Address</th>
            <th>IBAN</th>
            <th>Sort Fraud</th>
        </tr>
        </thead>
        <tbody>
        @foreach($scan->customers as $customer)
            <tr class="tr">
                <td class="td">{{ $customer->id }}</td>
                <td class="td">{{ $customer->first_name }}</td>
                <td class="td">{{ $customer->last_name }}</td>
                <td class="td">{{ $customer->date_of_birth }}</td>
                <td class="td">{{ $customer->phone_number }}</td>
                <td class="td">{{ $customer->ip_address }}</td>
                <td class="td">{{ $customer->iban }}</td>

                <td class="td">
                    @switch($customer->fraud)
                        @case('IBAN Fraud')
                            <span class="inline-block rounded-md bg-red-600/50 px-2 py-1 text-xs font-semibold uppercase text-red-900 antialiased w-32">IBAN Fraud</span>
                            @break
                        @case('Outside the Netherlands')
                            <span class="inline-block rounded-md bg-gray-600/50 px-2 py-1 text-xs font-semibold uppercase text-gray-900 antialiased w-32">Not In NL</span>
                            @break
                        @case('IP Address Fraud')
                            <span class="inline-block rounded-md bg-yellow-600/50 px-2 py-1 text-xs font-semibold uppercase text-yellow-900 antialiased w-32">IP Fraud</span>
                            @break
                        @case('Under Age')
                            <span class="inline-block rounded-md bg-orange-600/50 px-2 py-1 text-xs font-semibold uppercase text-orange-900 antialiased w-32">Under Age</span>
                            @break
                        @default
                            <span class="inline-block rounded-md bg-green-600/50 px-2 py-1 text-xs font-semibold uppercase text-green-100 antialiased w-32">No Fraud</span>
                    @endswitch
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
