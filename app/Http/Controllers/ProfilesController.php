<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Redirect;
use Session;

use \App\Profiles;
use \App\Logs;
use \App\Permissions;

class ProfilesController extends Controller
{
    public function index(Request $request)
    {   
        $logged = Auth::user();

        if (Permissions::permissaoModerador($logged)) {
            $profiles = Profiles::all();
        } else {
            $profiles = Profiles::where('r_auth', $logged->id)->orWhere('default', 1)->get();
        }
    
        Logs::cadastrar($logged->id, ($logged->name . ' vizualizou a lista de perfis'));

        return view('profiles.index', ['profiles' => $profiles]);
    }

    public function create()
    {
        $logged = Auth::user();

        return view('profiles.add');
    }

    public function store(Request $request)
    {  
        try {

            $profiles = new Profiles();
            
            $profiles->name = $request->get('name');
            $profiles->moderator = $request->get('moderator');
            $profiles->administrator = $request->get('administrator');

            $profiles->save();

            Session::flash('flash_success', "Perfil cadastrado com sucesso!");

            Logs::cadastrar(Auth::user()->id, (Auth::user()->name . ' cadastrou o perfil: ' . $profiles->name));

        } catch (Exception $e) {
            Session::flash('flash_error', "Erro ao cadastrar perfil!");
        }

        return Redirect::to('/profiles');
    }

    public function edit($id)
    {
        $profiles = Profiles::find($id);

        return view('profiles.edit', [
            'profiles' => $profiles, 
        ]);
    }

    public function update(Request $request)
    {   
        try {
                
            $profiles = Profiles::find($request->get('id'));
            
            $profiles->name = $request->get('name');
            $profiles->moderator = $request->get('moderator');
            $profiles->administrator = $request->get('administrator');

            $profiles->save();

            Session::flash('flash_success', "Perfil atualizado com sucesso!");

            Logs::cadastrar(Auth::user()->id, (Auth::user()->name . ' atualizou o perfil: ' . $profiles->name));

        } catch (Exception $e) {
            Session::flash('flash_error', "Erro ao atualizar perfil!");
        }

        return Redirect::to('/profiles');
    }

    public function destroy(Request $request)
    {   
        try {

            $profiles = Profiles::find($request->get('id'))->delete();

            Session::flash('flash_success', "Perfil excluído com sucesso!");

            Logs::cadastrar(Auth::user()->id, (Auth::user()->name . ' excluiu o perfil ID: ' . $request->get('id')));

        } catch (\Illuminate\Database\QueryException $e) {

            Session::flash('flash_error', 'Não é possível excluir este perfil!');

        } catch (Exception $e) {

            Session::flash('flash_error', "Erro ao excluir perfil!");
        }

        return Redirect::to('/profiles');
    }

    public function defaultProfile(Request $request)
    {  
        try {

            Profiles::where('default', 1)->update(['default' => 0]);

            $profile = Profiles::find($request->get('default'));

            $profile->default = 1;

            $profile->save();

            Session::flash('flash_success', "Perfil padrão atualizado com sucesso!");

            Logs::cadastrar(Auth::user()->id, (Auth::user()->name . ' informou um perfil padrão: ' . $profile->name));

        } catch (Exception $e) {
            Session::flash('flash_error', "Erro ao atualizado perfil padrão!");
        }

        return Redirect::to('/profiles');
    }

    public function perfil(Request $request)
    {   
        $logged = Auth::user();

        if ($request->isMethod('post')) {

            $data = $request->all();

            $auth = Auth::user();
            
            $auth->name = $data['name'];
            $auth->email = $data['email'];

            $profile = Profiles::find($data['profile_id']);

            if ($profile->administrator && (isset($auth->profile) && !$auth->profile->administrator)) {
                Session::flash('flash_error', "Você não tem permissão para mudar para este perfil.");
                return Redirect::to('/');
            } else {
                $auth->profile_id = $profile->id;
            }

            $auth->profession = $data['profession'];

            $auth->username = $data['username'];

            if ($data['password']) {
                $auth->password = bcrypt($data['password']);
            }

            if ($request->image) {
            
                $img = time().'.'.$request->image->getClientOriginalExtension();

                $request->image->move(public_path('images'), $img);

                $auth->image = $img;

            }

            $auth->save();

            Logs::cadastrar(Auth::user()->id, (Auth::user()->name . ' atualizou o próprio perfil'));

            Session::flash('flash_success', "Perfil atualizado com sucesso!");

            return Redirect::back();

        }

        $user = Auth::user();

        if (Permissions::permissaoModerador($logged)) {
            $profiles = Profiles::pluck('name', 'id');
        } else {
            $profiles = Profiles::where('r_auth', $logged->id)->orWhere('default', 1)->pluck('name', 'id');
        }

        return view('profiles.perfil', [
            'user' => $user,
            'profiles' => $profiles
        ]);
    }

}
