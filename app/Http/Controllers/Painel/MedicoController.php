<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Medico;
use App\Models\Painel\Especialidade;
use App\Http\Requests\Painel\MedicoFormRequest;

class MedicoController extends Controller
{
    
    private $medico;
    private $totalPage=3;
    
    public function __construct(Medico $medico) {
        $this->medico = $medico;
               
    }
      
    public function index(Medico $medico)
    {
       $title='Listagem dos Médicos';
       $medicos =  $this->medico->paginate($this->totalPage);       
       return view('Painel.Medico.index',compact('title','medicos'));
        
               
    }

    public function create()
    {
        $title = 'Cadastrar Novo Médico';
        
        $esps = Especialidade::all();
   
    return view('Painel.Medico.create-edit',compact('title','esps'));
    
    }

    public function store(MedicoFormRequest $request)
    {
        
         $dataForm = $request->all();
         //Pega todos os dados que vem do formulário
         
        $insert = $this->medico->create($dataForm);
         //realiza a inserção no BD; $insert recebe os dados do formulário.(exeto dados da especialidade)
       
         $esps_id =  $request->all('esp');
          //recebe o id da especialidade com junto com a string
         
         foreach($esps_id as $esp_id){
            $esps_id = $esp_id;
         }
            $esps_id; 
       //foreah para receber somente o Id da especialidade 
            
        $insert->especialidades()->sync($esps_id);
        //realiza a sincronização entre a tabela médicos, que está dentro do $insert, e a tabela
        //especialidades, pelo id. 
      
        if($insert)
            return redirect()->route('medico.index')->with('status','Médico Cadastrado com Sucesso!');
       else
           return redirect()->route('medico.create-edit');
    }
        //se caso inserir, redireciona para a rota informada. 
    public function show($id)
    {
    $medico = $this->medico->find($id);
      $title = "Nome do Médico: ($medico->nome)";
      
     return    view('Painel.Medico.show',compact('medico','title'));
    }

    public function edit($id)
    {
        $medico = $this->medico->find($id); 
        $title = "Editar Médico: ($medico->nome)";  
        $esps = Especialidade::all();
        return view('Painel.Medico.create-edit',compact('title','medico','esps'));
    }

    public function update(Request $request, $id)
    {
       
        $dataForm = $request->all();
        $medico = $this->medico->find($id);
        //$dataForm['active'] = (!isset($dataForm['active']) ) ? 0:1;
        $update = $medico->update($dataForm);
                        
        if($update)
            return redirect ()->route('medico.index')->with('status','Medico Alterado com Sucesso!');
        else
            return redirect()->route('medico.edit', $id)->with(['errors'=>'Falha ao editar']);
    }

    public function destroy($id)
    {
       $medico = $this->medico->find($id);
       $delete = $medico->delete();
       if($delete)
           return redirect ()->route('medico.index')->with('status','Exame Excluido com Sucesso!');
       else
           return redirect ()->route('medico.show', $id)->with(['errors'=>'Falha ao Excluir']);
    }    
}
