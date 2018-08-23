<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Redirect;
use Session;

use \App\User;
use \App\Profiles;
use \App\Logs;
use \App\Permissions;

class UsersController extends Controller
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
            $users = User::all();
        } else {
            $users = User::where('r_auth', $logged->id)->orWhere('id', $logged->id)->get();
        }

        Logs::cadastrar($logged->id, ($logged->name . ' visualizou a lista de usuários'));

        return view('users.index', [
            'users' => $users
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $logged = Auth::user();

        if (Permissions::permissaoModerador($logged)) {
            $profiles = Profiles::pluck('name', 'id');
        } else {
            $profiles = Profiles::where('r_auth', $logged->id)->orWhere('default', 1)->pluck('name', 'id');
        }
        
        $profile_id = Profiles::returnDefault();

        return view('users.add', [
            'profiles' => $profiles,
            'profile_id' => $profile_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        try {
            
            $data = $request->all();

            $user = new User();
            
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->profile_id = $data['profile_id'];
            $user->profession = $data['profession'];
            $user->username = $data['username'];
            $user->password = bcrypt($data['password']);

            if ($request->image) {
            
                $img = time().'.'.$request->image->getClientOriginalExtension();

                $request->image->move(public_path('images'), $img);

                $user->image = $img;

            }

            $user->save();

            Session::flash('flash_success', "Usuário cadastrado com sucesso!");

            Logs::cadastrar(Auth::user()->id, (Auth::user()->name . ' cadastrou o usuário: ' . $user->name));

        } catch (Exception $e) {
            Session::flash('flash_error', "Erro ao cadastrar usuário!");
        }

        return Redirect::to('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $logged = Auth::user();

        $user = User::find($id);

        if (Permissions::permissaoModerador($logged)) {
            $profiles = Profiles::pluck('name', 'id');
        } else {
            $profiles = Profiles::where('r_auth', $logged->id)->orWhere('default', 1)->pluck('name', 'id');
        }

        return view('users.edit', [
            'user' => $user, 
            'profiles' => $profiles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        try {

            $data = $request->all();

            $user = User::find($data['id']);
            
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->profile_id = $data['profile_id'];
            $user->profession = $data['profession'];
            $user->username = $data['username'];

            if ($data['password']) {
                $user->password = bcrypt($data['password']);
            }

            if ($request->image) {
            
                $img = time().'.'.$request->image->getClientOriginalExtension();

                $request->image->move(public_path('images'), $img);

                $user->image = $img;
            }

            $user->save();

            Session::flash('flash_success', "Usuário atualizado com sucesso!");

            Logs::cadastrar(Auth::user()->id, (Auth::user()->name . ' atualizou o usuário: ' . $user->name));

        } catch (Exception $e) {
            Session::flash('flash_error', "Erro ao atualizar usuário!");
        }

        return Redirect::to('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        try {

            User::find($request->get('id'))->delete();

            Session::flash('flash_success', "Usuário excluído com sucesso");

            Logs::cadastrar(Auth::user()->id, (Auth::user()->name . ' excluiu o usuário ID: ' . $request->get('id')));

        } catch (\Illuminate\Database\QueryException $e) {

            Session::flash('flash_error', 'Não é possível excluir este usuário!');

        } catch (Exception $e) {

            Session::flash('flash_error', "Erro ao excluir usuário!");
        }

        return Redirect::to('/users');
    }
}
