<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Painel\AgendaDeExames;
use App\Models\Painel\AgendaDeConsultas;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  view('Auth.login');
    }
    
    public function chart(){
        $fedbacks = DB::table('atendimento_exames')->get();
		return \Response::json($fedbacks);
    }
    
    public function agendamentosConsultas(){
        $agendamentosConsultas  =   AgendaDeConsultas::all();
	$especialidades[]       =   '';
        $exames                 =   AgendaDeExames::all();
        
        foreach ($agendamentosConsultas as $agendamentosConsulta){
            $especialidades =  $agendamentosConsulta->medico->especialidades;
        }      
        return \Response::json(['consultas'=>$agendamentosConsultas,'especialidades'=>$especialidades,'exames'=>$exames]);
    }
    
    public function dashboard(){
        $agendamentosExames         = [];
        $agendamentosConsultas      = [];
        $dataExame                  = AgendaDeExames::all(); 
        $dataConsultas              = AgendaDeConsultas::all();
           
        return view('Site.home.index', compact('calendarioExames','calendarioConsultas','dataExame'));
    } 
    
    
}
//        if($dataConsultas->count()) {
//            foreach ($dataConsultas as $key => $value) {
//                $agendamentosConsultas[] = Calendar::event(                      
//                 $value->paciente->nome,
//                    false,
//                    new \DateTime($value->data_consulta.$value->hora_consulta),
//                    new \DateTime($value->data_consulta.$value->hora_consulta.' +1 hora'),                   
//                    // Add color and link on event
//	                [
//	                    'color' => '#f0000',
//	                    'url' => route('agendarconsulta.show',$value->id),
//                           
//	                ]
//                );
//            }
//        }
//              
//        if($dataExame->count()) {
//            foreach ($dataExame as $key => $value) {
//                $agendamentosExames[] = Calendar::event(
//                 $value->exame->nome. " - " .$value->paciente->nome,
//                    false,
//                    new \DateTime($value->data_exame.$value->hora_exame),
//                    new \DateTime($value->data_exame.$value->hora_exame .' +1'),
//                    $value->hora_exame,
//                    // Add color and link on event
//	                [
//	                    'color' => '#f05050',
//	                    'url' => route('agendarexame.show',$value->id),                                              
//	                ]
//                );
//            }
//        }
//        $calendarioExames = Calendar::addEvents($agendamentosExames);
//                  
//        $calendarioConsultas = Calendar::addEvents($agendamentosConsultas);