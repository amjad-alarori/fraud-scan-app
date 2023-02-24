@extends('layouts.app')
@include('includes.header')
@section('content')

    <div class="flex items-center justify-center">
        <table class="border-collapse border border-gray-200 mt-8">
            <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-200 px-4 py-2 text-left">Scan ID</th>
                <th class="border border-gray-200 px-4 py-2 text-left">Created At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($scans as $scan)
                <tr class="border border-gray-200">

                    <th class="border border-gray-200 px-4 py-2 text-left">
                        <a href="{{ url('/scans/'.$scan->id) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white rounded px-4 py-2">See Scan {{ $scan->id }}</a>
                    </th>
                    <td class="border border-gray-200 px-4 py-2">{{ $scan->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
