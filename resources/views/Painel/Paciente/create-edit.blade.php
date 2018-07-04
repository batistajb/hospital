@extends('Painel.templates.template')

@section('conteudo')
    
<h1 Class="title-pg">
    Formulário de Pacientes: <b>{{$paciente->nome or 'Cadastrar'}}</b>
</h1>
<h3><a href="{{route('paciente.index')}}">​<i class="glyphicon glyphicon-arrow-left"></i>Voltar</a></h3>

@if(isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

@if(isset($paciente))

{!!Form::model($paciente, ['route'=>['paciente.update',$paciente->id],'class' =>'"form-inline', 'method'=>'put'])!!}
@else

    {!! Form::open(['route'=> 'paciente.store','class' => 'form']) !!}
@endif
<div class="container">

    <div class="col-sm-6">
        {!! Form::text('nome',null,['class'=>'form-control','placeholder'=>'Nome:']) !!}
    </div>
    
    <div class="col-sm-6">
          {!! Form::text('CNS',null,['class'=>'form-control','placeholder'=>'CNS:']) !!}
          <br>
    </div>

   
    <div class="col-sm-6">
         <label>Informe o Sexo:</label>
         <select class="form-control" name="sexo">
            <option value=""></option>
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>           
         </select>
    </div>
    
    <div class="col-sm-6">
        <label>Informe a Data de Nascimento:</label>
      {!! Form::date('datanasc',null,['class'=>'form-control','placeholder'=>'Data de Nascimento:']) !!}
      <br>
    </div>
    
    <div class="col-sm-6">
        {!! Form::text('endereco',null,['class'=>'form-control','placeholder'=>'Endereço:']) !!}
    </div>
    
    <div class="col-sm-6">
        {!! Form::text('bairro',null,['class'=>'form-control','placeholder'=>'Bairro:']) !!}
        <br>
    </div>

    <div class="col-sm-6">
        {!! Form::text('municipio',null,['class'=>'form-control','placeholder'=>'Município:']) !!}
        
    </div>
    
    <div class="col-sm-6">
        {!! Form::text('contato',null,['class'=>'form-control','placeholder'=>'Contato:']) !!}
      <br>
    </div>
  
       <div class="col-sm-6">
        {!!form::submit('Cadastrar',['class'=>'btn btn-primary'])!!}
          
       </div>

</div>
@endsection