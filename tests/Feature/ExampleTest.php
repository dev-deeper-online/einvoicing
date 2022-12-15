<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\ETA;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $receipt = new ETA\DTO\Receipt(
            new ETA\DTO\Header(
                now()->toDateTimeLocalString(),
                '0001',
            ),
            new ETA\DTO\Seller(
                562415149,
                'coup',
                branchAddress: new ETA\DTO\Address(
                    regionCity: 'el nozha',
                    street: 'josef tito',
                    buildingNumber: 74,
                    postalCode: 11223,
                )
            ),
            new ETA\DTO\Buyer(
                buyerName: 'sp',
            ),
            [

            ],
            657.89,
            749.995,
            657.89,
            taxTotals: [
                [
                    'taxType' => 'T1',
                    'subType' => 'V009',
                    'amount' => 92.105,
                    'rate' => 14,
                ],
            ]
        );

        app(ETA\APIs\Receipt::class)->submit(
            $receipt,
            fn ($response) => dd($response)
        );
    }
}
