<?php

namespace App\Http\Controllers;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as GuzzleClient;
use App\Models\Scan;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CustomerController extends Controller
{

    private const FRAUD_IP_ADDRESS = 'IP Address Fraud';
    private const FRAUD_IBAN = 'IBAN Fraud';
    private const NL_KEY = '+31';
    private const FRAUD_UNDERAGE = 'Under Age';
    private const BASE_URL = 'http://192.168.1.236:8080/api/v1/customers';
    /**
     * @var GuzzleClient
     */
    private GuzzleClient $httpClient;

    /**
     * @param GuzzleClient $httpClient
     */
    public function __construct(GuzzleClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @return bool
     */
    public function startsWith(string $haystack, string $needle): bool
    {
        return strncmp($haystack, $needle, strlen($needle)) === 0;
    }

    /**
     * @return Application|Factory|View
     * @throws \Exception
     */
    public function index()
    {
        try {
            $response = $this->httpClient->get(self::BASE_URL);
            $customers = json_decode($response->getBody(), true)['customers'];
        } catch (GuzzleException $e) {
            // handle the exception by redirecting the user to an error page
            return view('errors.error', ['message' => $e->getMessage()]);
        }

        $seen_ips = array();
        $seen_ibans = array();

        // Register the scan in DB
        $scan = Scan::create(['created_at' => Carbon::now()]);


        foreach ($customers as &$customer) {
            if (isset($seen_ips[$customer['ipAddress']])) {
                // This IP address has already been seen, so marking both customers as fraud.
                $customer['fraud'] = self::FRAUD_IP_ADDRESS;
                $seen_ips[$customer['ipAddress']]['fraud'] = self::FRAUD_IP_ADDRESS;
            } else {
                // This is the first time seeing this IP address, so just marking it as seen.
                $seen_ips[$customer['ipAddress']] = &$customer;
            }

            if (isset($seen_ibans[$customer['iban']])) {
                // This IBAN has already been seen, so marking both customers as fraud.
                $customer['fraud'] = self::FRAUD_IBAN;
                $seen_ibans[$customer['iban']]['fraud'] = self::FRAUD_IBAN;
            } else {
                // This is the first time seeing this IBAN, so just marking it as seen.
                $seen_ibans[$customer['iban']] = &$customer;
            }

            // This uses the startWith() method above to check on the first numbers in every phone number and marking fraud when finding not NL number.
            if (!$this->startsWith($customer['phoneNumber'], self::NL_KEY)) {
                $customer['fraud'] = 'Outside the Netherlands';
            }

            $birthdate = new \DateTime($customer['dateOfBirth']);
            $now = new \DateTime();
            $age = $now->diff($birthdate)->y;

            if ($age < 18) {
                $customer['fraud'] = self::FRAUD_UNDERAGE;
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
