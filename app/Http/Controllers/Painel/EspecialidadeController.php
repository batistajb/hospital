<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Especialidade;
use App\Http\Requests\Painel\EspecialidadeFormRequest;

class EspecialidadeController extends Controller
{
    
    private $especialidade;
    private $totalPage=3;
    
    public function __construct(Especialidade $especialidade) {
        $this->especialidade = $especialidade;
               
    }
      
    public function index(Especialidade $especialidade)
    {
        $title='Listagem das Especialidades';
        $especialidades =  $this->especialidade->paginate($this->totalPage);
        return view('Painel.Especialidade.index',compact('especialidades','title'));
    }

    public function create()
    {
        $title = 'Cadastrar Nova Especialidade';
       
        return view('Painel.Especialidade.create-edit',compact('title'));
    }

    public function store(EspecialidadeFormRequest $request)
    {
        //Pega todos os dados que vem do formulário
        $dataForm = $request->all();
        
        //$dataForm['active'] = (!isset($dataForm['active']) ) ? 0:1;
               
        //Faz o cadastro
        $insert = $this->especialidade->create($dataForm);
        
        if($insert)
            return redirect()->route('especialidade.index')->with('status','Especialidade Cadastrada com Sucesso!');
        else
            return redirect()->route('especialidade.create-edit');
    }

    public function show($id)
    {
      $especialidades = $this->especialidade->find($id);
      $title = "Nome da Especialidade: ($especialidades->nome)";
      
      return view('Painel.Especialidade.show',compact('especialidades','title'));
    }

    public function edit($id)
    {
        $especialidades = $this->especialidade->find($id); 
        $title = "Editar Especialidade: ($especialidades->nome)";
  
        return view('Painel.Especialidade.create-edit',compact('title','especialidades'));
    }

    public function update(Request $request, $id)
    {
       
        $dataForm = $request->all();
        $especialidades = $this->especialidade->find($id);
        //$dataForm['active'] = (!isset($dataForm['active']) ) ? 0:1;
        $update = $especialidades->update($dataForm);
                        
        if($update)
            return redirect ()->route('especialidade.index')->with('status','Especialidade Alterada com Sucesso!');
        else
            return redirect()->route('especialidade.edit', $id)->with(['errors'=>'Falha ao editar']);
    }

    public function destroy($id)
    {
       $especialidades = $this->especialidade->find($id);
       $delete = $especialidades->delete();
       if($delete)
           return redirect ()->route('especialidade.index')->with('status','Especialidade Excluida com Sucesso!');
       else
           return redirect ()->route('especialidade.show', $id)->with(['errors'=>'Falha ao Excluir']);
    }    
}

