<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class DealCriteria extends Eloquent
{
    protected $table = 'deal_criteria';

    public $timestamps = false;

    protected $softDelete = false;
}
