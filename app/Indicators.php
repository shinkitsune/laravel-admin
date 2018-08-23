<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicators extends Model
{
   	protected $table = 'r_indicators';
   	protected $primaryKey = 'id';

    protected $guarded = ['_token'];
}
