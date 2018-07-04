@extends('painel.templates.template')

@section('conteudo')

<h1 class='title-pg'>Relatório de Consultas</h1>


<div class="form-group" id="mensagem" >
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}                
    </div>
    @endif
</div>

{!! Form::open(['route'=> 'relatorioconsulta.index','class' => 'form']) !!}
<div class="col-sm-4">
    <label>Selecione a Especialidade da Consulta: </label>

    <select name="especialidade_id" class="form-control">
        <option value="">Todos</option>
        @foreach($especialidades as $especialidade)        
        <option value="{{$especialidade->id}}">{{$especialidade->nome}}</option>      
        @endforeach
    </select>      
</div>

<div class="col-sm-6">

    <div class="col-sm-6">
        <label>Selecione a data inicial:</label>
        {!! Form::date('dataum',null,['class'=>'form-control']) !!}  
    </div>
    <div class="col-sm-6">
        <label>Selecione a data final:</label>
        {!! Form::date('datadois',null,['class'=>'form-control']) !!}  
    </div>
</div>

<div class="col-sm-6">
    <hr> 
    {!!form::submit('Buscar',['class'=>'btn btn-primary'])!!}
    <br>
</div>

{!!form::close()!!}


@if($layout == 1)

<div class="col-sm-8">
    <table class="table table-hover">
        <br>
        <thead>
        <h3>Informações</h3>
        </thead>

        @if($var == 2 )      
 
        <tr>
            <th>Especialidade</th>
            <th>Quantidade</th>
        </tr>   

        <tr>
            
            <td>{{$nomeespecialidade}}</td>
            <td>{{$agendamentosconsultas_cont}}</td>
        </tr>  
        @endif

        @if($var == 1) 

        <tr>
            <th>Especialidade</th>
            @foreach ($nomeespecialidade as $nome)  
            <td>  {{$nome}}</td>
            <td></td> 
            @endforeach   
        </tr>
        <tr>
            <th>Quantidade</th>
            @foreach ($agendamentosconsultas as $quant) 
            <td>  {{$quant}}</td>
            <td></td> 
            @endforeach   
            
        </tr>

        @endif

        
        @if($var == 3)

        <tr>
            <th>Especialidade</th>
            <th>Quantidade</th>
        </tr>   

        <td>{{$mensagem}}</td>
        <td></td>
        @endif

        @if($var == 4)
        <tr>
            <th>Especialidade</th>
            <th>Quantidade</th>
        </tr>   

        <td>{{$mensagem2}}</td>
        <td></td>        
        @endif
    </table>
</div>

@endif

@endsection
