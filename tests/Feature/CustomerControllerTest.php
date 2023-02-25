<?php

namespace Tests\Feature;

use App\Http\Controllers\CustomerController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;


class CustomerControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @throws \Exception
     */
    public function testIndex()
    {
        // Create some mock customer data
        $customers = [
            [
                'customerId' => $this->faker->randomNumber(),
                'bsn' => $this->faker->ssn,
                'firstName' => $this->faker->firstName,
                'lastName' => $this->faker->lastName,
                'dateOfBirth' => $this->faker->date(),
                'phoneNumber' => $this->faker->phoneNumber,
                'email' => $this->faker->email,
                'tag' => $this->faker->word,
                'ipAddress' => $this->faker->ipv4,
                'iban' => $this->faker->iban('NL'),
            ]
        ];

        // Mock the HTTP client to return the mock customer data
        $mockHttpClient = Mockery::mock(\GuzzleHttp\Client::class);
        $mockHttpClient->shouldReceive('get')->once()->andReturn(new \GuzzleHttp\Psr7\Response(200, [], json_encode(['customers' => $customers])));

        // Inject the mock HTTP client into the controller
        $controller = new \App\Http\Controllers\CustomerController($mockHttpClient);

        // Call the index method
        $response = $controller->index();

        // Assert that the response is a view
        $this->assertInstanceOf(\Illuminate\View\View::class, $response);

        // Assert that the view has a customers variable
        $this->assertTrue($response->offsetExists('customers'));

        // Assert that the customers variable is an array
        $this->assertIsArray($response['customers']);


    }


}

