<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\AgendaDeConsultas;
use App\Models\Painel\Paciente;
use App\Models\Painel\Medico;
use App\Models\Painel\Especialidade;
use App\Http\Requests\Painel\AgendaDeConsultasFormRequest;
use DB;
use PDF;
use Response;

class AgendaDeConsultasController extends Controller {

    private $agenda;
    private $totalPage = 3;

    public function __construct(AgendaDeConsultas $agenda) {
        $this->agenda = $agenda;
    }

    public function index(AgendaDeConsultas $agenda) {
        $title = 'Listagem dos Agendamentos';
        $agenda = $this->agenda->with('paciente')->paginate($this->totalPage);

        return view('Painel.AgendaConsulta.index', compact('title', 'agenda'));
//         $agenda = $this->agenda->find(2);
//     
//        $pacientes = $agenda->pacientes;
//                     
//        foreach ($pacientes as $paciente){
//            echo $paciente->nome;
//        }
//                    
    }

    public function create() {
        $title = 'Cadastrar Novo Agendamento';

        $pacientes = Paciente::all();

        $medicos = Medico::all();

        $usuarios = auth()->user();
        //recupera os dados do usuario logado atualmente

        return view('Painel.AgendaConsulta.create', compact('title', 'pacientes', 'medicos', 'usuarios'));
    }

    public function store(AgendaDeConsultasFormRequest $request) {

        //Pega todos os dados que vem do formulário
        $dataForm = $request->all();

        $dataconsulta = $request->data_consulta;

        $especialidadeid = $request->especialidade_id;
        //id da especialidade
        $consulta = Especialidade::find($especialidadeid);
        //recupera todos os Ids da especialidade
        $numvagasconsulta = $consulta->numvagas;
        //numero de vagas da consulta(especialidade) referente ao id digitado pelo usuario.

        $quantdatas = DB::table('agenda_de_consultas')
                        ->where([
                            ['data_consulta', '=', $dataconsulta],
                            ['especialidade_id', '=', $especialidadeid],
                        ])->get()->count();
        //retorna a quantidade de datas e exames iguais a que estou tentando inserir. (request) 

        if ($quantdatas < $numvagasconsulta) {
            $insert = $this->agenda->create($dataForm);
            if ($insert) {
                return redirect()->route('agendarconsulta.index')->with('status', 'Agendamento Realizado com Sucesso!');
            } else {
                return redirect()->route('agendarconsulta.create');
            }
        } else {

            return redirect('painel/agendarconsulta/create')->with('status', 'Vagas Esgotadas Para Esta Data!');
        }
        //faz a verificação da disponibilidade de vagas para o exame desejado. 
    }

    public function show($id) {
       
         
       $agenda = AgendaDeConsultas::find($id);

        
            $especialidades = $agenda->medico->especialidades;
            
            foreach($especialidades as $esp){
                $especialidade[] = $esp->nome;
            }
            
          
            $title = "Agendamentos:";
       
            //dd($agenda);
            return view('Painel.AgendaConsulta.show', compact('especialidade',  'agenda', 'title'));
    }

    public function edit($id) {
        $agenda = $this->agenda->find($id);
       
        $title = "Editar Agendamento: ($agenda->exames)";

        $pacientes = Paciente::all();

        $medicos = Medico::all();
        //$usuarios = auth()->user(); 
        $usuarios = auth()->user();
        //recupera os dados do usuario logado atualmente

        return view('Painel.AgendaConsulta.edit', compact('title', 'agenda', 'pacientes', 'medicos', 'usuarios'));
    }

    public function update(Request $request, $id){

        $dataForm = $request->all();
        $agenda = $this->agenda->find($id);
        //$dataForm['active'] = (!isset($dataForm['active']) ) ? 0:1;
        $update = $agenda->update($dataForm);

        if ($update)
            return redirect()->route('agendarconsulta.index')->with('status', 'Agendamento Alterado com Sucesso!');
        else
            return redirect()->route('agendarconsulta.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    public function destroy($id) {
        $agenda = $this->agenda->find($id);
        $delete = $agenda->delete();
           
        if ($delete)
            return redirect()->route('agendarconsulta.index')->with('status', 'Agendamento Excluido com Sucesso!');
        else
            return redirect()->route('agendarconsulta.show', $id)->with(['errors' => 'Falha ao Excluir']);
    }

    public function getEspecialidades($id) {

        $medicos = Medico::find($id);

        // retorna todos os medicos e suas especialidades de acordo com o id;
        return Response::json($medicos->especialidades);
    }
    
    public function getPdf($id){
       
        $agenda = AgendaDeConsultas::find($id);
        
        $especialidade_id =  $agenda->especialidade_id;
        
        $especialidade = Especialidade::find($especialidade_id);

        view('Painel.AgendaConsulta.showpdf', compact('agenda','especialidade'));  
       
        $pdf = PDF::LoadView('Painel.AgendaConsulta.showpdf',['agenda' => $agenda,'especialidade' => $especialidade ]);
       
        return  $pdf->download('agendaconsulta.pdf');
        
    }
        
}

