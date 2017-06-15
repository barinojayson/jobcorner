<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class DealOffer extends Eloquent
{
    protected $table = 'deal_offer';

    public $timestamps = false;

    protected $softDelete = false;
    
}
