@extends('layouts.app')
@section('content')

    @foreach($scans as $scan)
        <h2>Scan {{ $scan->id }} - {{ $scan->created_at }}</h2>
    @endforeach

    <div class="flex items-center justify-center">
        <table class="border-separate border-spacing-y-2 text-sm">
            <thead class="sr-only">
            <tr>
                <th>Customer ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Sort Fraud</th>
            </tr>
            </thead>
            <tbody>
            @foreach($scan->customers()->paginate(10) as $customer)
                <tr class="tr">
                    <td class="td">{{ $customer->id }}</td>
                    <td class="td">{{ $customer->first_name }}</td>
                    <td class="td">{{ $customer->last_name }}</td>
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
                            @default
                                <span class="inline-block rounded-md bg-green-600/50 px-2 py-1 text-xs font-semibold uppercase text-green-100 antialiased w-32">No Fraud</span>
                        @endswitch
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>
    <div class="flex items-center justify-center">
        {{ $scan->customers()->paginate(10)->links() }}
    </div>
@stop
