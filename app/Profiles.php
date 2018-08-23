<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
   	protected $table = 'r_profiles';
   	protected $primaryKey = 'id';

    protected $guarded = ['_token'];

    static public function returnDefault()
    {
    	$profile = self::where('default', 1)->first();

        if ($profile) {
        	return $profile->id;
        }
        return null;
    }
}
