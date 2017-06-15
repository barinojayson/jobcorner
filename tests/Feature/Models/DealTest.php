<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Deal;

class DealTest extends TestCase
{
    /**
     * test get deal data
     */
    public function testGetDealCriteria()
    {
        $deal_with_criteria = Deal::with('criteria')->first();
        $this->assertArrayHasKey('id', $deal_with_criteria->toArray());
        $this->assertArrayHasKey('name', $deal_with_criteria->toArray());
        $this->assertNotNull($deal_with_criteria->criteria);

        $deal_with_criteria->criteria->map(function ($criteria) {
            $this->assertArrayHasKey('deal_id', $criteria->toArray());
            $this->assertArrayHasKey('product_id', $criteria->toArray());
            $this->assertArrayHasKey('quantity', $criteria->toArray());
            $this->assertArrayHasKey('condition', $criteria->toArray());
        });
    }

    /**
     * test no deal data retrieved
     */
    public function testGetCustomerNoData()
    {
        $deal_not_found = Deal::whereId(9999999)->first();
        $this->assertNull($deal_not_found);
    }

    /**
     * test get deal offer retrieved
     */
    public function testGetDealOffer()
    {
        $deal_offer = Deal::with('offer')->first();
        $this->assertArrayHasKey('id', $deal_offer->toArray());
        $this->assertArrayHasKey('name', $deal_offer->toArray());
        $this->assertArrayHasKey('offer', $deal_offer->toArray());
        $this->assertNotNull($deal_offer->offer);

        $deal_offer->offer->map(function ($offer) {
            $this->assertArrayHasKey('deal_id', $offer->toArray());
            $this->assertArrayHasKey('product_id', $offer->toArray());
            $this->assertArrayHasKey('free_product_quantity', $offer->toArray());
            $this->assertArrayHasKey('discounted_price', $offer->toArray());
        });
    }
}
