<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Deal extends Eloquent
{
    protected $table = 'deals';

    protected $softDelete = false;
    
    
    public function offer()
    {
        return $this->hasMany(DealOffer::class, 'deal_id', 'id');
    }
    
    public function criteria()
    {
        return $this->hasMany(DealCriteria::class, 'deal_id', 'id');
    }
    
}
