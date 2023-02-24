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
class CustomerController extends Controller
{
    /**
     * @throws GuzzleException
     */
    public function index()
    {
        try {
        $client = new Client([
            'base_uri' => 'http://192.16s8.1.236:8080/api/v1/',
            'timeout' => 10.0,
        ]);

        $response = $client->get('customers');

        $customers = json_decode($response->getBody(), true)['customers'];
        } catch (GuzzleException $e) {
            // handle the exception by redirecting the user to an error page
            return view('errors.error', ['message' => $e->getMessage()]);
        }

        $seen_ips = array();
        $seen_ibans = array();

        $scan = Scan::create(['created_at' => Carbon::now()]);

        function startsWith(string $haystack, string $needle): bool
        {
            return strncmp($haystack, $needle, strlen($needle)) === 0;
        }

        foreach ($customers as &$customer) {
            if (isset($seen_ips[$customer['ipAddress']])) {
                // This IP address has already been seen, so mark both customers as fraud.
                $customer['fraud'] = 'IP Address Fraud';
                $seen_ips[$customer['ipAddress']]['fraud'] = 'IP Address Fraud';
            } else {
                // This is the first time seeing this IP address, so just mark it as seen.
                $seen_ips[$customer['ipAddress']] = &$customer;
            }

            if (isset($seen_ibans[$customer['iban']])) {
                // This IBAN has already been seen, so mark both customers as fraud.
                $customer['fraud'] = 'IBAN Fraud';
                $seen_ibans[$customer['iban']]['fraud'] = 'IBAN Fraud';
            } else {
                // This is the first time seeing this IBAN, so just mark it as seen.
                $seen_ibans[$customer['iban']] = &$customer;
            }

            if (!startsWith($customer['phoneNumber'], '+31')) {
                $customer['fraud'] = 'Outside the Netherlands';
            }

            $birthdate = new \DateTime($customer['dateOfBirth']);
            $now = new \DateTime();
            $age = $now->diff($birthdate)->y;

            if ($age < 18) {
                $customer['fraud'] = 'Under Age';
            }


            // Create a new customer model
            $customerModel = Customer::create([
                'customer_id' => $customer['customerId'],
                'bsn' => $customer['bsn'],
                'first_name' => $customer['firstName'],
                'last_name' => $customer['lastName'],
                'date_of_birth' => $customer['dateOfBirth'],
                'phone_number' => $customer['phoneNumber'],
                'email' => $customer['email'],
                'tag' => $customer['tag'],
                'ip_address' => $customer['ipAddress'],
                'iban' => $customer['iban'],
                'fraud' => $customer['fraud'] ?? null,
            ]);

            // Attach the customer model to the scan
            $scan->customers()->attach($customerModel);
        }
        unset($customer); // unset the reference to avoid potential bugs later


        return view('customers.index', compact('customers'));


    }
}
