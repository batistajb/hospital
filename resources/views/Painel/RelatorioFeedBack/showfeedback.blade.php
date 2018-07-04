@extends('painel.templates.template')

@section('conteudo')

<h1 class='title-pg'>Relatório FeedBack Paciente</h1>

<div class="form-group" id="mensagem" >
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}                
    </div>
    @endif
</div>

{!! Form::open(['route'=> 'relatoriofeedback.store','class' => 'form']) !!}

<div class="col-sm-6">

    <div class="col-sm-6">
        <label>Selecione a data inicial:</label>
        {!! Form::date('dataum',null,['class'=>'form-control']) !!}  
    </div>
    <div class="col-sm-6">
        <label>Selecione a data final:</label>
        {!! Form::date('datadois',null,['class'=>'form-control']) !!}  
    </div>

<div class="col-sm-6">
    <hr> 
    {!!form::submit('Buscar Relatório',['class'=>'btn btn-primary'])!!}
</div>
    
   
</div>
{!!form::close()!!}

@if($layout == 1)

<div class="col-sm-8">
    <table class="table table-hover">
        <br>
        <thead>
        <h3>Informações - Relatório Geral </h3>
        </thead>
     
        <tr>
            <th>Quantidade total de FeedBacks:</th>
            <th>Média Geral do atendimento:</th>
            <th>Qualidade:</th>
            

        </tr>   

        <tr>
            <td>{{$quantidadetotalfeedback}}</td>
            <td>{{$mediaGeral}}</td>
            <td>{{$notaAtendimento}}</td>
        </tr>  
      
    </table>
</div>  

    
@endif


@endsection
