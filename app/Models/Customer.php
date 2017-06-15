<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\Customer_Offer;

class Customer extends Eloquent
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function customerOffers()
    {
        return $this->hasMany(CustomerOffer::class, 'customer_id', 'id');
    }
}
