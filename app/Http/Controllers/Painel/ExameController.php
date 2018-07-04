<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\exame;
use App\Http\Requests\Painel\ExameFormRequest;

class ExameController extends Controller
{
    
    private $exame;
    private $totalPage=3;
    
    public function __construct(exame $exame) {
        $this->exame = $exame;
               
    }
      
    public function index(exame $exame)
    {
        $title='Listagem dos Exames';
        $exames =  $this->exame->paginate($this->totalPage);
        return view('Painel.Exame.index',compact('exames','title'));
    }

    public function create()
    {
        $title = 'Cadastrar Novo Exame';
       
        return view('Painel.Exame.create-edit',compact('title'));
    }

    public function store(ExameFormRequest $request)
    {
        //Pega todos os dados que vem do formulário
        $dataForm = $request->all();
        
       
        //$dataForm['active'] = (!isset($dataForm['active']) ) ? 0:1;
               
        //Faz o cadastro
        $insert = $this->exame->create($dataForm);
        
        if($insert)
            return redirect()->route('exame.index')->with('status','Exame Cadastrado com Sucesso!');
        else
            return redirect()->route('exame.create-edit');
    
        
        
    }

    public function show($id)
    {
      $exame = $this->exame->find($id);
      $title = "Nome do Exame: ($exame->nome)";
      
      return view('Painel.Exame.show',compact('exame','title'));
    }

    public function edit($id)
    {
        $exame = $this->exame->find($id); 
        $title = "Editar Exame: ($exame->nome)";       
        return view('Painel.Exame.create-edit',compact('title','exame'));
    }

    public function update(Request $request, $id)
    {
       
        $dataForm = $request->all();
        $exame = $this->exame->find($id);
        //$dataForm['active'] = (!isset($dataForm['active']) ) ? 0:1;
        $update = $exame->update($dataForm);
                        
        if($update)
            return redirect ()->route('exame.index')->with('status','Exame Alterado com Sucesso!');
        else
            return redirect()->route('exame.edit', $id)->with(['errors'=>'Falha ao editar']);
    }

    public function destroy($id)
    {
       $exame = $this->exame->find($id);
       $delete = $exame->delete();
       if($delete)
           return redirect ()->route('exame.index')->with('status','Exame Excluído com Sucesso!');
       else
           return redirect ()->route('exame.show', $id)->with(['errors'=>'Falha ao Excluir']);
    }    
}
