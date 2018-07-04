@extends('painel.templates.template')

@section('conteudo')

<h1 class='title-pg'>Listagem dos Agendamentos de Exames</h1>
<a href="{{route('agendarexame.create')}}" class="btn btn-primary btn-add"><span class="glyphicon glyphicon-plus"></span>Agendar</a>
<div class="form-group" id="mensagem" >
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}                
    </div>
    @endif
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function () {
            $('#mensagem').fadeOut(1500);
        }, 2000);
    });   
</script>


<table class="table table-hover">
    <tr>
        <th>Nome do Paciente</th>
        <th>Nome do Exame</th>
        <th>Nome do Tecnico</th>     
        <th>Data</th>
        <th>Horário</th>   

        <th width="100px">Ações</th>
    </tr>           
    @foreach ($agenda as $ags)
    <tr>

        <td>           
            {{$ags->paciente->nome}}                                  
        </td>        
        <td>
            {{$ags->exame->nome}}
        </td>
        <td>
            {{$ags->tecnico->nome}}
        </td>
        <td>
            {{\Carbon\Carbon::parse($ags->data_exame)->format('d/m/Y')}}
        </td>
        <td>
            {{$ags->hora_exame}}
        </td>


        <td>
            <a href="{{route('agendarexame.edit',$ags->id)}}" class='actions edit'>                
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <a href="{{route('agendarexame.show',$ags->id)}}" class='actions delete'>
                <span class="glyphicon glyphicon-zoom-in"></span>
            </a> 
                       
              <a href="{{route('PDF-agenda-exame',$ags->id)}}" class='actions edit'>
             <span class="glyphicon glyphicon-save-file"></span>
             </a> 
        </td>
    </tr>
    @endforeach

</table>


{!! $agenda->links()!!}

@endsection
