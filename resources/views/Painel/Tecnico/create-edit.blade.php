@extends('Painel.templates.template')

@section('conteudo')
    
<h1 Class="title-pg">
    Formulário de Tecnicos: <b>{{$tecnico->nome or 'Cadastrar'}}</b>
</h1>
<h3><a href="{{route('tecnico.index')}}">​<i class="glyphicon glyphicon-arrow-left"></i>Voltar</a></h3>

@if(isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

@if(isset($tecnico))
 {!!Form::model($tecnico, ['route'=>['tecnico.update',$tecnico->id],'class' =>'form', 'method'=>'put'])!!}
@else
    {!! Form::open(['route'=> 'tecnico.store','class' => 'form']) !!}
@endif
    <div class="form-group">
        {!! Form::text('nome',null,['class'=>'form-control','placeholder'=>'Nome do Técnico:']) !!}
    </div>  

        
        {!!form::submit('Cadastrar',['class'=>'btn btn-primary'])!!}
        
</form>


@endsection