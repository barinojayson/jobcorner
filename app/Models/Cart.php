<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Cart extends Eloquent
{
    protected $table = 'carts';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
