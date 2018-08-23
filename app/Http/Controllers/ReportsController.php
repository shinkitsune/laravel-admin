<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Redirect;
use Session;
use PDF;

use \App\Logs;
use \App\Permissions;
use \App\Reports;

class ReportsController extends Controller
{
    public function index(Request $request)
    {   
        $logged = Auth::user();

        if (Permissions::permissaoModerador($logged)) {
            $reports = Reports::all();
        } else {
            $reports = Reports::where('r_auth', $logged->id)->get();
        }

        Logs::cadastrar(Auth::user()->id, (Auth::user()->name . ' vizualizou a lista de relatórios'));

        return view('reports.index', ['reports' => $reports]);
    }

    public function create()
    {
        return view('reports.add');
    }

    public function store(Request $request)
    {  
        try {

            $data = $request->all();

            $reports = new Reports();
            
            $reports->name = $data['name'];
            $reports->query = $data['query'];
            $reports->description = $data['description'];
            $reports->size = $data['size'];

            if ($request->image) {
            
                $img = time().'.'.$request->image->getClientOriginalExtension();

                $request->image->move(public_path('images'), $img);

                $reports->image = $img;

            }

            $reports->save();

            Session::flash('flash_success', "Relatório cadastrado com sucesso!");

            Logs::cadastrar(Auth::user()->id, (Auth::user()->name . ' cadastrou um relatório: ' . $reports->name));

        } catch (Exception $e) {
            Session::flash('flash_error', "Erro ao cadastrar relatório!");
        }

        return Redirect::to('/reports');
    }

    public function edit($id)
    {
        $reports = Reports::find($id);

        return view('reports.edit', [
            'reports' => $reports, 
        ]);
    }

    public function generate($id)
    {
        $report = Reports::find($id);

        $query = DB::select($report->query);

        $data = [
            'report' => $report,
            'query' => $query,
            'columns' => array_keys((array)$query[0]),
        ];

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);

        $pdf = PDF::loadView('pdf', $data)->setPaper('a4', 'landscape');

        return $pdf->download( $report->name . '.pdf' );
    }

    public function update(Request $request)
    {   
        try {

            $data = $request->all();

            $reports = Reports::find($request->get('id'));
            
            $reports->name = $data['name'];
            $reports->query = $data['query'];
            $reports->description = $data['description'];
            $reports->size = $data['size'];

            if ($request->image) {
            
                $img = time().'.'.$request->image->getClientOriginalExtension();

                $request->image->move(public_path('images'), $img);

                $reports->image = $img;

            }

            $reports->save();

            Session::flash('flash_success', "Relatório atualizado com sucesso!");

            Logs::cadastrar(Auth::user()->id, (Auth::user()->name . ' atualizou um relatório: ' . $reports->name));

        } catch (Exception $e) {
            Session::flash('flash_error', "Erro ao atualizar relatório!");
        }

        return Redirect::to('/reports');
    }

    public function destroy(Request $request)
    {   
        try {
         
            $reports = Reports::find($request->get('id'))->delete();

            Session::flash('flash_success', "Relatório excluído com sucesso!");

            Logs::cadastrar(Auth::user()->id, (Auth::user()->name . ' excluiu o relatório ID: ' . $request->get('id')));

        } catch (\Illuminate\Database\QueryException $e) {

            Session::flash('flash_error', 'Não é possível excluir este relatório!');

        } catch (Exception $e) {

            Session::flash('flash_error', "Erro ao excluir relatório!");
        }

        return Redirect::to('/reports');
    }
}
