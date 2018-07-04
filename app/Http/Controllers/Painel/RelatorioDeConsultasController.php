<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\AgendaDeConsultas;
use App\Models\Painel\Paciente;
use App\Models\Painel\Medico;
use App\Models\Painel\Exame;
use App\Models\Painel\Especialidade;
use DB;
use Response;
use PDF;
use Illuminate\Support\Facades\Auth;

class RelatorioDeConsultasController extends Controller {

    public function index() {
        $acesso = Auth::user()->acesso;
         if ($acesso == 0) {
        $title = 'Relatorio de Consultas';
        $layout = 0;

        $especialidades = Especialidade::all();

        return view('Painel.RelatorioConsultas.index', compact('title', 'especialidades', 'layout'));
    }else 
            return redirect()->route('dashboard');        
}  
        
    

    public function store(Request $request) {
        
        $acesso = Auth::user()->acesso;
        if ($acesso == 0) {
        $request->dataum;
        $especialidadeid = $request->especialidade_id;
        $dataum = $request->dataum;
        $datadois = $request->datadois;
        $layout = 1;
        $title = 'Relatorio de Consultas';
        $especialidades = Especialidade::all();
        $request->pdf;

   
        if ($especialidadeid == null && $dataum != null && $datadois != null) {

            foreach ($especialidades as $especialidade) {

                $nomeespecialidade[] = $especialidade->nome;
            }//Retorna o nome de todas as especialidades cadastrados.


            foreach ($especialidades as $especialidade) {

                $idespecialidade[] = $especialidade->id;
            }

            foreach ($idespecialidade as $id) {

                $agendamentosconsultas[] = AgendaDeConsultas::All()
                        ->where('data_consulta', '>=', $dataum)
                        ->where('data_consulta', '<=', $datadois)
                        ->where('especialidade_id', '=', $id)
                        ->count();
                 
                $id_esp[] = AgendaDeConsultas::all()
                        ->where('data_consulta', '>=', $dataum)
                        ->where('data_consulta', '<=', $datadois)
                        ->where('especialidade_id', '=', $id);
                
            }
           
            $var = 1;
        } else

        if ($especialidadeid != null && $dataum != null && $datadois != null) {

            $agendamentosconsultas = AgendaDeConsultas::all()
                    ->where('data_consulta', '>=', $dataum)
                    ->where('data_consulta', '<=', $datadois)
                    ->where('especialidade_id', '=', $especialidadeid);

            $agendamentosconsultas_cont = AgendaDeConsultas::all()
                    ->where('data_consulta', '>=', $dataum)
                    ->where('data_consulta', '<=', $datadois)
                    ->where('especialidade_id', '=', $especialidadeid)
                    ->count(); //retorna a quantidade de exames;

            foreach ($agendamentosconsultas as $agendamentosconsulta) {
                $nomeespecialidade = $agendamentosconsulta->medico->especialidades;
                $id_esp = $agendamentosconsulta->id;
            }
         
            $especialidade = Especialidade::find($especialidadeid);


            if (empty($nomeespecialidade)) {
                $nomeespecialidade = 'Não Existem Consultas de ' . $especialidade->nome . ' Agendados Nesta Data';
            } else {


                foreach ($nomeespecialidade as $nome) {
                    $nomeespecialidade = $nome->nome;
                }
            }

            $var = 2;

            $especialidades = Especialidade::all();
        } else

        if ($especialidadeid == null && $dataum == null or $datadois == null) {

            $mensagem = 'Selecione datas de início e fim!';

            $var = 3;
        } else

        if ($especialidadeid != null && $dataum == null or $datadois == null) {

            $agendamentosconsultas = AgendaDeConsultas::all()
                    ->where('especialidade_id', '=', $especialidadeid);

            foreach ($agendamentosconsultas as $agendamentosconsulta) {

                $nomeespecialidade = $agendamentosconsulta->medico->especialidades->nome;
            }  //retorna o nome do exame que estou pesquisando.  


            $mensagem2 = "Não existem consultas com " . $nomeespecialidade . " agendados para esta data!";
            $var = 4;
        }
                             
        return  view('Painel.RelatorioConsultas.index', compact('agendamentosconsultas_cont', 'var', 'mensagem', 'mensagem2', 'dataum', 'datadois', 'title', 'nomeespecialidade', 'especialidades', 'layout', 'agendamentosconsultas', 'especialidadeid'));
    
    } else
            return redirect()->route('dashboard');
    }
    
    
            }
          
        
    
        
    
    
    
    

