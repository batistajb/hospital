<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function __construct() {
        //$this->middleware('auth');
        
        //$this->middleware('auth')->only(['contato','categoria']);
        
        //$this->middleware('auth')->except(['index','contato']);
        
        
    }
    
    public function index(){
            //        $teste = 123;
            //        $teste1 = 723;
            //        $teste2 = 153;
        //return view('teste',['teste'=>$teste]);
          
        
        $title= 'Titulo Teste';
        return view('site.home.index',compact('title'));
        
    }
    
    public function contato(){
        return view('site.contato.index');
    }
    
    public function categoria($id){
        return "Listagem dos posts da categoria: {$id}";
    }
     public function categoriaOp($id = 1){
        return "Listagem dos posts da categoriaOp: {$id}";
    }
  
}
