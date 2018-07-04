<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Tecnico;
use App\Http\Requests\Painel\TecnicoFormRequest;

class TecnicoController extends Controller
{
    
    private $tecnico;
    private $totalPage=3;
    
    public function __construct(Tecnico $tecnico) {
        $this->tecnico = $tecnico;
               
    }
      
    public function index(Tecnico $tecnico)
    {
        $title='Listagem dos Técnicos';
        $tecnicos =  $this->tecnico->paginate($this->totalPage);
        return view('Painel.Tecnico.index',compact('tecnicos','title'));
    }

    public function create()
    {
        $title = 'Cadastrar Novo Exame';
       
        return view('Painel.Tecnico.create-edit',compact('title'));
    }

    public function store(TecnicoFormRequest $request)
    {
        //Pega todos os dados que vem do formulário
        $dataForm = $request->all();
        
        //$dataForm['active'] = (!isset($dataForm['active']) ) ? 0:1;
               
        //Faz o cadastro
        $insert = $this->tecnico->create($dataForm);
        
        if($insert)
            return redirect()->route('tecnico.index')->with('status','Técnico Cadastrado com Sucesso!');
        else
            return redirect()->route('tecnico.create-edit');
    }

    public function show($id)
    {
      $tecnico = $this->tecnico->find($id);
      $title = "Nome do Tecnico: ($tecnico->nome)";
      
      return view('Painel.Tecnico.show',compact('tecnico','title'));
    }

    public function edit($id)
    {
        $tecnico = $this->tecnico->find($id); 
        $title = "Editar Tecnico: ($tecnico->nome)";       
        return view('Painel.Tecnico.create-edit',compact('title','tecnico'));
    }

    public function update(Request $request, $id)
    {
       
        $dataForm = $request->all();
        $tecnico = $this->tecnico->find($id);
        //$dataForm['active'] = (!isset($dataForm['active']) ) ? 0:1;
        $update = $tecnico->update($dataForm);
                        
        if($update)
            return redirect ()->route('tecnico.index')->with('status','Técnico Alterado com Sucesso!');
        else
            return redirect()->route('tecnico.edit', $id)->with(['errors'=>'Falha ao editar']);
    }
 
    public function destroy($id)
    {
       $tecnico = $this->tecnico->find($id);
       $delete = $tecnico->delete();
       if($delete)
           return redirect ()->route('tecnico.index')->with('status','Técnico Excluido com Sucesso!');
       else
           return redirect ()->route('tecnico.show', $id)->with(['errors'=>'Falha ao Excluir']);
    }    
}
