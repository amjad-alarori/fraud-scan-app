<?php

namespace App\Http\Controllers;
use App\Models\User;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Models\Scan;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ScanController extends Controller
{
    public function index()
    {
        $scans = Scan::with('customers')->get();

        return view('scans.index', compact('scans'));
    }

    public function show($id)
    {
        $scan = Scan::find($id);

        return view('scans.show', [
            'scan' => $scan
        ]);
    }


    public function api()
    {
        $scans = Scan::with('customers')->get();

        return response()->json($scans);
    }
}
