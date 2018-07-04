<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\AgendaDeExames;
use App\Models\Painel\Paciente;
use App\Models\Painel\Medico;
use App\Models\Painel\Exame;
use DB;
use Response;
use Illuminate\Support\Facades\Auth;
use PDF;

class RelatorioDeExamesController extends Controller {

    public function index() {
        $acesso = Auth::user()->acesso;
        
        if ($acesso == 0) {
            $title = 'Relatorio de Exames';
            $layout = 0;            
            $exames = Exame::all();
            return view('Painel.RelatorioExames.index', compact('title', 'exames', 'layout'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function store(Request $request) {

        $acesso = Auth::user()->acesso;
        
        if ($acesso == 0) {

            $request->dataum;
            $exameid = $request->exame_id;
            $dataum = $request->dataum;
            $datadois = $request->datadois;
            $layout = 1;
            $title = 'Relatorio de Exames';
            $exames = Exame::all();



            if ($exameid == null && $dataum != null && $datadois != null) {

                foreach ($exames as $exame) {

                    $nomeexame[] = $exame->nome;
                }//Retorna o nome de todos os exames cadastrados.


                foreach ($exames as $exame) {

                    $idexame[] = $exame->id;
                }

                foreach ($idexame as $id) {
                    $agendamentosexames[] = AgendaDeExames::all()
                            ->where('data_exame', '>=', $dataum)
                            ->where('data_exame', '<=', $datadois)
                            ->where('exame_id', '=', $id)
                            ->count();
                }

                $var = 1;
            } else

            if ($exameid != null && $dataum != null && $datadois != null) {

                $agendamentosexames = AgendaDeExames::all()
                        ->where('data_exame', '>=', $dataum)
                        ->where('data_exame', '<=', $datadois)
                        ->where('exame_id', '=', $exameid);


                $agendamentosexames_cont = AgendaDeExames::all()
                        ->where('data_exame', '>=', $dataum)
                        ->where('data_exame', '<=', $datadois)
                        ->where('exame_id', '=', $exameid)
                        ->count(); //retorna a quantidade de exames;



                foreach ($agendamentosexames as $agendamentosexame) {
                    $nomeexame = $agendamentosexame->exame->nome;
                }

                $exames = Exame::all()
                        ->where('id', '=', $exameid);

                foreach ($exames as $exa) {
                    $exame = $exa->nome;
                }

                if (empty($nomeexame)) {
                    $nomeexame = 'Não Existe Exames de ' . $exame . ' Agendados Nesta Data';
                }


                $var = 2;

                $exames = Exame::all();
            } else
            if ($exameid == null && $dataum == null or $datadois == null) {

                $mensagem = 'Selecione datas de início e fim!';

                $var = 3;
            } else

            if ($exameid != null && $dataum == null or $datadois == null) {

                $agendamentosexames = AgendaDeExames::all()
                        ->where('exame_id', '=', $exameid);

                foreach ($agendamentosexames as $agendamentosexame) {

                    $nomeexame = $agendamentosexame->exame->nome;
                }  //retorna o nome do exame que estou pesquisando.  


                $mensagem2 = "Não existem exames de " . $nomeexame . " agendados para esta data!";
                $var = 4;
                
            }
                return view('Painel.RelatorioExames.index', compact('exames', 'var', 'mensagem', 'mensagem2', 'dataum', 'datadois', 'title', 'nomeexame', 'layout', 'agendamentosexames_cont', 'agendamentosexames'));   
                
                } else
                    
            return redirect()->route('dashboard');
    }

}
