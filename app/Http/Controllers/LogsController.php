<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use \App\Logs;
use \App\Permissions;

class LogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logged = Auth::user();
        
        if (Permissions::permissaoModerador($logged)) {
            $logs = Logs::all();
        } else {
            $logs = Logs::where('r_auth', $logged->id)->get();
        }

        return view('logs.index', ['logs' => $logs]);
    }
}
