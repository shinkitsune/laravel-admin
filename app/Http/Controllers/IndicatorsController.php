<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Redirect;
use Session;

use \App\Logs;
use \App\Permissions;
use \App\Indicators;

class IndicatorsController extends Controller
{
    public function index(Request $request)
    {   
        $logged = Auth::user();

        if (Permissions::permissaoModerador($logged)) {
            $indicators = Indicators::all();
        } else {
            $indicators = Indicators::where('r_auth', $logged->id)->get();
        }

        Logs::cadastrar(Auth::user()->id, (Auth::user()->name . ' vizualizou a lista de indicadores'));

        return view('indicators.index', ['indicators' => $indicators]);
    }

    public function create()
    {
        return view('indicators.add');
    }

    public function store(Request $request)
    {  
        try {

            $data = $request->all();

            $indicators = new Indicators();
            
            $indicators->name = $data['name'];
            $indicators->query = $data['query'];
            $indicators->color = $data['color'];
            $indicators->description = $data['description'];
            $indicators->link = $data['link'];
            $indicators->size = $data['size'];
            $indicators->glyphicon = $data['glyphicon'];

            $indicators->r_auth = Auth::user()->id;

            $indicators->save();

            Session::flash('flash_success', "Indicador cadastrado com sucesso!");

            Logs::cadastrar(Auth::user()->id, (Auth::user()->name . ' cadastrou um indicador: ' . $indicators->name));

        } catch (Exception $e) {
            Session::flash('flash_error', "Erro ao cadastrar indicador!");
        }

        return Redirect::to('/indicators');
    }

    public function edit($id)
    {
        $indicators = Indicators::find($id);

        return view('indicators.edit', [
            'indicators' => $indicators, 
        ]);
    }

    public function update(Request $request)
    {   
        try {

            $data = $request->all();

            $indicators = Indicators::find($request->get('id'));
            
            $indicators->name = $data['name'];
            $indicators->query = $data['query'];
            $indicators->color = $data['color'];
            $indicators->description = $data['description'];
            $indicators->link = $data['link'];
            $indicators->size = $data['size'];
            $indicators->glyphicon = $data['glyphicon'];

            $indicators->save();

            Session::flash('flash_success', "Indicador atualizado com sucesso!");

            Logs::cadastrar(Auth::user()->id, (Auth::user()->name . ' atualizou um indicador: ' . $indicators->name));

        } catch (Exception $e) {
            Session::flash('flash_error', "Erro ao atualizar indicador!");
        }

        return Redirect::to('/indicators');
    }

    public function destroy(Request $request)
    {   
        try {

            Indicators::find($request->get('id'))->delete();

            Session::flash('flash_success', "Indicador excluído com sucesso!");

            Logs::cadastrar(Auth::user()->id, (Auth::user()->name . ' excluiu o indicador ID: ' . $request->get('id')));

        } catch (\Illuminate\Database\QueryException $e) {

            Session::flash('flash_error', 'Não é possível excluir este indicador!');

        } catch (Exception $e) {

            Session::flash('flash_error', "Erro ao excluir indicador!");
        }

        return Redirect::to('/indicators');
    }
}
