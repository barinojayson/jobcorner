<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Product extends Eloquent
{
    protected $table = 'products';

    public $timestamps = false;

    protected $softDelete = false;
}
