<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
   	protected $table = 'r_reports';
   	protected $primaryKey = 'id';

    protected $guarded = ['_token'];
}
