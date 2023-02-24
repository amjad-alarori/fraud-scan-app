
<h1>All Scans</h1>
<td><button onclick="location.href='{{ url('') }}'">Return Home</button></td>
@foreach($scans as $scan)
    <h2>Scan {{ $scan->id }} - {{ $scan->created_at }}</h2>
    <ul>
        @foreach($scan->customers as $customer)
            <li>Customer {{ $customer->id }} - {{ $customer->first_name }} {{ $customer->last_name }} ({{ $customer->fraud ?? 'No fraud detected' }})</li>
        @endforeach
    </ul>
@endforeach
