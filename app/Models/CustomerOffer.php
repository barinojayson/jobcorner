<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CustomerOffer extends Eloquent
{
    protected $table = 'customer_offers';

    public $timestamps = false;

    protected $softDelete = false;
    
    public function deal()
    {
        return $this->hasMany(Deal::class, 'id', 'deal_id');
    }
    
}
