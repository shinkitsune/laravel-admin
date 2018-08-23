<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
   	protected $table = 'r_logs';
   	protected $primaryKey = 'id';

    protected $guarded = ['_token'];

    static public function cadastrar($user_id, $message)
    {
        self::create([
            'description' => $message,
            'r_auth' => $user_id
        ]);
    }
}
