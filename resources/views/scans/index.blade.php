@extends('layouts.app')
@include('includes.header')
@section('content')

    <div class="flex items-center justify-center">
        <table class="border-separate border-spacing-y-2 text-sm">
            <thead class="">
            <tr class="">
                <th>Created At</th>
                <th>Scan ID</th>
            </tr>
            </thead>
            <tbody>
            @foreach($scans as $scan)
                <tr>
                    <td class="td">{{ $scan->created_at }}</td>
                    <td class="td">
                <span class="float-right rounded-md bg-green-600/50 px-4 py-px text-xs font-semibold uppercase text-green-900 antialiased">
                    <a href="{{ url('/scans/'.$scan->id) }}">See Scan {{ $scan->id }}</a>
                </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>


