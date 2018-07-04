<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\AtendimentoExame;
use App\Models\Painel\Exame;
use DB;
use Response;
use Illuminate\Support\Facades\Auth;

class RelatorioDeFeedBacksController extends Controller {

private $AtendimentoExame;
    public function __construct(AtendimentoExame $AtendimentoExame) {
        $this->AtendimentoExame = $AtendimentoExame;               
    }
       
     public function index()
    {
        $acesso = Auth::user()->acesso;
        if ($acesso == 0) {
        $title = 'FeedBack do Paciente';       
        return view('Painel.RelatorioFeedBack.index',compact('title'));
    }else {
            return redirect()->route('dashboard');
          }
    }

    public function store(Request $request) {
        
        if ($acesso == 0) {
            
        $layout = 1;
     
        $dataForm = $request->all();
              
        $insert = $this->AtendimentoExame->create($dataForm);
        
            if($insert)
            
                return redirect()->back()->with('status','FeedBack Registrado com Sucesso!');
            
            else
            
                return redirect()->route('feedback.index','layout');
            
    } else
            return redirect()->route('dashboard');
    }
            
            public function relatorio() {
                $acesso = Auth::user()->acesso;
                if ($acesso == 0) {
 
                $layout = 0;
                $feedback = AtendimentoExame::all();
                
               return view('Painel.RelatorioFeedBack.showfeedback',compact('feedback','layout'));
                
            }else
                return redirect()->route('dashboard');
            }
            
             
            public function relatorioStore(Request $request) {

                $layout = 1;
                $dataum = $request->dataum;
                $datadois = $request->datadois;
                
             $quantidadetotalfeedback = AtendimentoExame::all()
                        ->count();
                                                
                 $feedbacks = AtendimentoExame::all()
                    ->where('created_at', '>=', $dataum)
                    ->where('updated_at', '<=', $datadois);
                    
               $feedbacks_pessimo = AtendimentoExame::all()
                    ->where('created_at', '>=', $dataum)
                    ->where('updated_at', '<=', $datadois)
                    ->where('pessimo', '=', 1)
                    ->count();
               
               $feedbacks_ruin = AtendimentoExame::all()
                    ->where('created_at', '>=', $dataum)
                    ->where('updated_at', '<=', $datadois)
                    ->where('ruim', '=', 2)
                    ->count();
               
               $feedbacks_regular = AtendimentoExame::all()
                    ->where('created_at', '>=', $dataum)
                    ->where('updated_at', '<=', $datadois)
                    ->where('regular', '=', 3)
                    ->count();
               
               $feedbacks_bom = AtendimentoExame::all()
                    ->where('created_at', '>=', $dataum)
                    ->where('updated_at', '<=', $datadois)
                    ->where('bom', '=', 4)
                    ->count();
               
               $feedbacks_otimo = AtendimentoExame::all()
                    ->where('created_at', '>=', $dataum)
                    ->where('updated_at', '<=', $datadois)
                    ->where('otimo', '=', 5)
                    ->count();
                              
                             
                $TotalGeral =  $feedbacks_pessimo + $feedbacks_ruin + $feedbacks_regular + $feedbacks_bom + $feedbacks_otimo;
                              
                $mediaGeral = $TotalGeral/5;
                
                
                
                if($mediaGeral <= 1){
                    $notaAtendimento = 'Péssimo';
                }
                
                if(($mediaGeral > 1)and($mediaGeral <= 2)){
                    $notaAtendimento = 'Ruim';
                }
                
                if(($mediaGeral > 2)&&($mediaGeral <= 3)){
                    $notaAtendimento = 'Regular';
                }
                
                 if(($mediaGeral > 3)&&($mediaGeral <= 4)){
                    $notaAtendimento = 'Bom';
                }
                
                 if(($mediaGeral > 4)&&($mediaGeral <= 5)){
                    $notaAtendimento = 'Otimo';
                }

       
                    
                foreach($feedbacks as $feedback){
                     
                    if($feedback->pessimo==1){
                      $feedbacks_pessimo; 
                     }
                     
                     if($feedback->ruim==2){
                       $feedbacks_ruin; 
                     }
                     
                    if($feedback->regular==3){
                       $feedbacks_regular;
                    }
                    
                    if($feedback->bom==4){
                       $feedbacks_bom;
                    }
                                           
                    if($feedback->otimo==5){
                         $feedbacks_ruin;
                    }  
                       
                   }//Retorna a quantidade de cada qualidade;  
                
          
                return view('Painel.RelatorioFeedBack.showfeedback',compact('quantidadetotalfeedback','layout','feedback','notaAtendimento','mediaGeral'));
                
            }
    
}
    
