<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\AgendaDeExames;
use App\Models\Painel\Paciente;
use App\Models\Painel\Exame;
use App\Models\Painel\Tecnico;
use App\Http\Requests\Painel\AgendaDeExamesFormRequest;
use DB;
use PDF;

class AgendaDeExamesController extends Controller {

    private $agenda;
    private $totalPage = 3;

    public function __construct(AgendaDeExames $agenda) {
        $this->agenda = $agenda;
    }

    public function index(AgendaDeExames $agenda) {
      $title = 'Listagem dos Agendamentos';
    $agenda = $this->agenda->with('paciente')->paginate($this->totalPage);   
     return    view('Painel.AgendaExame.index', compact('title', 'agenda'));        
//         $agenda = $this->agenda->find(2);
//     
//        $pacientes = $agenda->pacientes;
//                     
//        foreach ($pacientes as $paciente){
//            echo $paciente->nome;
//        }        
    }

    public function create() {
        $title = 'Cadastrar Novo Agendamento';

        $pacientes = Paciente::all();
        
        $exames = Exame::all();
        
        $tecnicos = Tecnico::all();
        //$usuarios = auth()->user(); 
        $usuarios = auth()->user(); 
        //recupera os dados do usuario logado atualmente
        
     return   view('Painel.AgendaExame.create-edit', compact('title', 'pacientes', 'exames', 'tecnicos','usuarios'));
    }

    public function store( AgendaDeExamesFormRequest $request) {

    //Pega todos os dados que vem do formulário
        $dataForm = $request->all();
        
        $dataexame = $request->data_exame;
        //data do exame
        $exameid = $request->exame_id;
        //id do exame
        $exame = Exame::find($exameid);
        //recupera todos os dados do exame
        $numvagasexame = $exame->numvagas;
        //numero de vagas do exame
        
             $quantdatas = DB::table('agenda_de_exames')
                ->where([
                    ['data_exame', '=', $dataexame],
                    ['exame_id', '=', $exameid],    
                ])->get()->count();
        //retorna a quantidade de datas e exames iguais a que estou tentando inserir. (request) 
               
            if($quantdatas < $numvagasexame){                
                 $insert = $this->agenda->create($dataForm);
                     if($insert){
                       return redirect()->route('agendarexame.index')->with('status','Agendamento Realizado com Sucesso!');
                     }else{               
                     return redirect()->route('agendarexame.create-edit');} 
            } else{
               
            return redirect('painel/agendarexame/create')->with('status','Vagas Esgotadas Para Esta Data!');}               
                //faz a verificação da disponibilidade de vagas para o exame desejado. 
   
   
    }

    public function show($id) {
        $agenda = $this->agenda->find($id);       
        $title = "Agendamentos:";
        //dd($agenda);        
        return view('Painel.AgendaExame.show', compact('agenda', 'title'));
             
    }

    public function edit($id) {
        $agenda = $this->agenda->find($id);
        $title = "Editar Agendamento: ($agenda->exames)";
          
        $pacientes = Paciente::all();        
        $exames = Exame::all();        
        $tecnicos = Tecnico::all();
        //$usuarios = auth()->user(); 
        $usuarios = auth()->user(); 
        //recupera os dados do usuario logado atualmente
        return view('Painel.AgendaExame.create-edit', compact('title', 'agenda','pacientes','exames','tecnicos','usuarios'));
    }

    public function update(Request $request, $id) {

        $dataForm = $request->all();
        $agenda = $this->agenda->find($id);
        //$dataForm['active'] = (!isset($dataForm['active']) ) ? 0:1;
        $update = $agenda->update($dataForm);

        if ($update)
            return redirect()->route('agendarexame.index')->with('status','Agendamento Alterado com Sucesso!');
        else
            return redirect()->route('agendarexame.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    public function destroy($id) {
        $agenda = $this->agenda->find($id);
        $delete = $agenda->delete();
        if ($delete)
            return redirect()->route('agendarexame.index')->with('status','Agendamento Excluído com Sucesso!');
        else
            return redirect()->route('agendarexame.show', $id)->with(['errors' => 'Falha ao Excluir']);
    }

    public function getPdf($id){
        
        $agenda = $this->agenda->find($id);
    
     
        
        view('Painel.AgendaExame.showpdf', compact('agenda'));  
       
        $pdf = PDF::LoadView('Painel.AgendaExame.showpdf',['agenda' => $agenda]);
       
            return  $pdf->download('agendaexame.pdf');
        
   
       
    
    
}
}
