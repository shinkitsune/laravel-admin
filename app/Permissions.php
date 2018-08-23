<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Permissions extends Model
{
   	protected $table = 'r_permissions';
   	protected $primaryKey = 'id';

    protected $guarded = ['_token'];

    static public function permissaoUsuario($logged, $perm)
    {	
        if (isset($logged->perfil) && $logged->perfil->administrator) {
            return true;
        }
        
        $permissao = self::where('controller', $perm)->where('user_id', Auth::user()->id)->count();

        if ($permissao) {
        	return true;
        }
        return false;
    }

    static public function permissaoModerador($logged)
    {
        if (isset($logged->perfil) && ($logged->perfil->moderator || $logged->perfil->administrator)) {
        	return true;
        }
        return false;
    }

    static public function permissaoAdministrador($logged)
    {
        if (isset($logged->perfil) && $logged->perfil->administrator) {
        	return true;
        }
        return false;
    }

    static public function hasPermission($permissao)
    {
    	return self::where('controller', $permissao)->where('user_id', Auth::user()->id)->count();
    }
}
