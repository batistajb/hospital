<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;

class UsuarioController extends Controller
{    
    private $usuario;
    private $totalPage=3;
    
    public function __construct(User $usuario) {
        $this->usuario = $usuario;               
    }
      
    public function index(User $usuario)
    {
        $title='Listagem dos Usuários';
        $usuarios =  $this->usuario->paginate($this->totalPage);
        return view('Painel.Usuario.index',compact('usuarios','title'));
    }

    public function create()
    {
        $title = 'Cadastrar Novo Exame';
       
        return view('Painel.Usuario.create-edit',compact('title'));
    }

    public function store(Request $request){
    
       
        //Pega todos os dados que vem do formulário
        
        
        if($request->password == $request->password1){
        
            
        $dataForm = $request->all();
               
        
        //Faz o cadastro
        $insert = User::create($dataForm);
        
        $insert->password = Hash::make($request->password);
        
        $insert->save();
        
        if($insert)
            return redirect()->route('usuario.index')->with('status','Usuário Cadastrado com Sucesso!');
        else
            return redirect()->route('usuario.create-edit');
        
        }
        else
            return redirect()->back()->with('status','As senhas informada não coincidem!');        
        }

    public function show($id)
    {
      $usuario = $this->usuario->find($id);
      $title = "Nome do Usuário: ($usuario->name)";
      
      return view('Painel.Usuario.show',compact('usuario','title'));
    }

    public function edit($id)
    {
        $usuario = $this->usuario->find($id); 
        $title = "Editar Usuario: ($usuario->name)";       
        return view('Painel.Usuario.create-edit',compact('title','usuario'));
    }

    public function update(Request $request, $id)
    {       
         if($request->password == $request->password1){
        
        $dataForm = $request->all();
        $usuario = $this->usuario->find($id);
        //$dataForm['active'] = (!isset($dataForm['active']) ) ? 0:1;
        $update = $usuario->update($dataForm);
                        
        if($update)
            return redirect ()->route('usuario.index')->with('status','Usuário Alterado com Sucesso!');
        else
            return redirect()->route('usuario.edit', $id)->with(['errors'=>'Falha ao editar']);
    }else
            return redirect()->back()->with('status','As senhas informada não coincidem!');        
        }
 
    public function destroy($id)
    {
       $usuario = $this->usuario->find($id);
       $delete = $usuario->delete();
       if($delete)
           return redirect ()->route('usuario.index')->with('status','Usuário Excluido com Sucesso!');
       else
           return redirect ()->route('usuario.show', $id)->with(['errors'=>'Falha ao Excluir']);
    }    
}
