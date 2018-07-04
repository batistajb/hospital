@extends('Painel.templates.template')

@section('conteudo')
    
<h1 Class="title-pg">
    Formulário de Exames: <b>{{$exame->nome or 'Cadastrar'}}</b>
</h1>
<h3><a href="{{route('exame.index')}}">​<i class="glyphicon glyphicon-arrow-left"></i>Voltar</a></h3>

@if(isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

@if(isset($exame))
 {!!Form::model($exame, ['route'=>['exame.update',$exame->id],'class' =>'form', 'method'=>'put'])!!}
@else
    {!! Form::open(['route'=> 'exame.store','class' => 'form']) !!}
@endif
    <div class="form-group">
        {!! Form::text('nome',null,['class'=>'form-control','placeholder'=>'Nome do Exame:']) !!}
    </div>  
    <div class="form-group">
        {!! Form::text('numvagas',null,['class'=>'form-control','placeholder'=>'Quantidade de vagas por dia:']) !!}
    </div>
        
        {!!form::submit('Cadastrar',['class'=>'btn btn-primary'])!!}
        
</form>


@endsection