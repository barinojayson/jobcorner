<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\CustomerOffer;

class CustomerOfferTest extends TestCase
{
    /**
     * test get customer offer and corresponding deal data
     */
    public function testGetCustomerOfferDeal()
    {
        $customer_offer = CustomerOffer::with('deal')->first();
        
        $this->assertArrayHasKey('id', $customer_offer->toArray());
        $this->assertArrayHasKey('customer_id', $customer_offer->toArray());
        $this->assertArrayHasKey('deal_id', $customer_offer->toArray());
        $this->assertArrayHasKey('deal', $customer_offer->toArray());
        $this->assertNotNull($customer_offer->deal);
    }

    /**
     * test no customer offer data retrieved
     */
    public function testGetCustomerOfferNoData()
    {
        $customer_offer = CustomerOffer::whereId(9999999)->first();
        $this->assertNull($customer_offer);
    }
}
