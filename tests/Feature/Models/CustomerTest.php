<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Customer;

class CustomerTest extends TestCase
{
    /**
     * retrieve sample customer data including customer offer
     */
    public function testGetCustomer()
    {
        $customer = Customer::with('customerOffers')->first();
        
        $this->assertArrayHasKey('id', $customer->toArray());
        $this->assertArrayHasKey('name', $customer->toArray());
        $this->assertArrayHasKey('contact_number', $customer->toArray());
        $this->assertArrayHasKey('priviledged', $customer->toArray());
        $this->assertArrayHasKey('customer_offers', $customer->toArray());
        $this->assertNotNull($customer->customerOffers);
    }

    /**
     * test no customer data retrieved
     */
    public function testGetCustomerNoData()
    {
        $customer = Customer::whereId(9999999)->first();     
        $this->assertNull($customer);
    }
}
