<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Paciente;
use App\Http\Requests\Painel\PacienteFormRequest;

class PacienteController extends Controller
{
    
    private $paciente;
    private $totalPage=3;
    
    public function __construct(Paciente $paciente) {
        $this->paciente = $paciente;
               
    }
      
    public function index(Paciente $paciente)
    {
        $title='Listagem dos pacientes';
        $pacientes =  $this->paciente->paginate($this->totalPage);
        return view('Painel.Paciente.index',compact('pacientes','title', 'dataordenada'));
    }

    public function create()
    {
        $title = 'Cadastrar Novo Paciente';   
        return view('Painel.Paciente.create-edit',compact('title'));
    }

    public function store(PacienteFormRequest $request)
    {
        //Pega todos os dados que vem do formulário
        $dataForm = $request->all();
        
        //$dataForm['active'] = (!isset($dataForm['active']) ) ? 0:1;
               
        //Faz o cadastro
        $insert = $this->paciente->create($dataForm);
        
        if($insert)
            return redirect()->route('paciente.index')->with('status','Paciente Cadastrado com Sucesso!');
        else
            return redirect()->route('paciente.create-edit');
    }

    public function show($id)
    {
      $paciente = $this->paciente->find($id);
      $title = "Nome do Paciente: ($paciente->nome)";
      
      return view('Painel.Paciente.show',compact('paciente','title'));
    }

    public function edit($id)
    {
        $paciente = $this->paciente->find($id); 
        $title = "Editar Paciente: ($paciente->nome)";
        
        return view('Painel.Paciente.create-edit',compact('title','paciente'));
    }

    public function update(PacienteFormRequest $request, $id)
    {
       
        $dataForm = $request->all();
        $paciente = $this->paciente->find($id);
        //$dataForm['active'] = (!isset($dataForm['active']) ) ? 0:1;
        $update = $paciente->update($dataForm);
                        
        if($update)
            return redirect ()->route('paciente.index')->with('status','Paciente Alterado com Sucesso!');
        else
            return redirect()->route('paciente.edit', $id)->with(['errors'=>'Falha ao editar']);
    }

    public function destroy($id)
    {
       $paciente = $this->paciente->find($id);
       $delete = $paciente->delete();
       if($delete)
           return redirect ()->route('paciente.index')->with('status','Paciente Excluido com Sucesso!');
       else
           return redirect ()->route('paciente.show', $id)->with(['errors'=>'Falha ao Excluir']);
    }    
}
