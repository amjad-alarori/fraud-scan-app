<?php

namespace App\Http\Controllers;
use App\Models\User;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;
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
        $cachedScans = Cache::get('scans_index');

        if ($cachedScans) {
            // If the scans are found in the cache, return them
            $scans = $cachedScans;
        } else {
            // If the scans are not found in the cache, retrieve them from the database
            $scans = Scan::with('customers')->get();

            // Store the scans in the cache for future requests
            Cache::put('scans_index', $scans, now()->addMinutes(30)); // Cache for 30 minutes
        }

        return view('scans.index', compact('scans'));
    }

    public function show($id)
    {
        // Try to retrieve the Scan model from the cache
        $scan = Cache::get('scan_' . $id);

        if (!$scan) {
            // If the Scan model is not found in the cache, retrieve it from the database
            $scan = Scan::find($id);

            // Store the Scan model in the cache for future requests
            Cache::put('scan_' . $id, $scan, now()->addMinutes(30)); // Cache for 30 minutes
        }

        return view('scans.show', [
            'scan' => $scan
        ]);
    }


    public function api()
    {
        $cachedResults = Cache::get('scans_api_results');

        if ($cachedResults) {
            return response()->json($cachedResults);
        } else {
            $scans = Scan::with('customers')->get();
            Cache::put('scans_api_results', $scans, now()->addMinutes(5));
            return response()->json($scans);
        }
    }
}
