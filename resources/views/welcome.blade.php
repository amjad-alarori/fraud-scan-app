@extends('layouts.app')
@section('content')

    <body class="flex flex-col justify-center items-center h-screen bg-gradient-to-br from-purple-600 to-indigo-900">
    <div class="grid grid-cols-2 gap-4">
        <button class="bg-gradient-to-br from-purple-500 to-indigo-600 hover:from-purple-600 hover:to-indigo-700 text-white font-bold py-8 px-8 rounded-full transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110" onclick="location.href='{{ url('customers') }}'">
            Scan Customers
        </button>
        <button class="bg-gradient-to-br from-green-500 to-teal-600 hover:from-green-600 hover:to-teal-700 text-white font-bold py-8 px-8 rounded-full transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110" onclick="location.href='{{ url('scans') }}'">
            Show Scans
        </button>
    </div>
    </body>

@stop


