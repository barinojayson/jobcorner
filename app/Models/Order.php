<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\Order_Detail;
use App\Models\Order_Freebie;

class Order extends Eloquent
{
    protected $table = 'order';
    protected $primaryKey = 'id';
    public $timestamps = true;
	
	public function details()
    {
        return $this->hasMany(Order_Detail::class, 'order_id', 'id');
    }
	
	public function freebies()
    {
        return $this->hasMany(Order_Freebie::class, 'order_id', 'id');
    }
}
