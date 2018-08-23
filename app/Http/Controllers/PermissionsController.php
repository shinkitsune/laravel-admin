<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Redirect;
use Route;
use Session;

use \App\User;
use \App\Logs;
use \App\Permissions;

class PermissionsController extends Controller
{
    public function show($id)
    {  
        $logged = Auth::user();

		$controllers = [];

		foreach (Route::getRoutes()->getRoutes() as $route)
		{
		    $action = $route->getAction();

		    if (array_key_exists('controller', $action))
		    {	
		    	if (strpos($action['controller'], 'Auth') === false && $action['controller'] != 'App\Http\Controllers\HomeController@index') {
                    $controllers[] = $action['controller'];
			    }
		    }
		}

        $perms = Permissions::where('user_id', $id)->pluck('controller', 'id');
        
        $user = User::find($id);

        Logs::cadastrar(Auth::user()->id, (Auth::user()->name . ' vizualizou a lista de permissões'));

        return view('permissions.index', [
            'lista' => $controllers,
            'perms' => $perms,
        	'user' => $user
        ]);
    }

    public function store(Request $request)
    {
    	Permissions::where('user_id', Auth::user()->id)->delete();

        $permissions = $request->get('permissions');

	    foreach ($permissions as $key => $value) {

        	$permission = new Permissions();

            $permission->controller = $value;
        	$permission->user_id = $request->get('id');
        	$permission->r_auth = Auth::user()->id;

        	$permission->save();
	    }

        Session::flash('flash_success', "Permissões cadastradas com sucesso!");

        Logs::cadastrar(Auth::user()->id, (Auth::user()->name . ' atualizou permissões do usuário ID:' . $permission->user_id));

        return Redirect::to('/users');
    }
}
