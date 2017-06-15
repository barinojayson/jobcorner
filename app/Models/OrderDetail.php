<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class OrderDetail extends Eloquent
{
    protected $table = 'order_details';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
