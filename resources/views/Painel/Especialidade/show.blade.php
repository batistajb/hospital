@extends('Painel.templates.template')

@section('conteudo')

<h1 class='title-pg'>    
    <a href="{{route('especialidade.index')}}">​<span class="glyphicon glyphicon-arrow-left">Voltar</span></a>
    Especialidade: <b>{{$especialidades->nome}}</b>
</h1>
<br>

<p><b>Nome da Especialidade:</b> {{$especialidades->nome}}</p>

<hr>

@if(isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

{!! Form::open(['route'=>['especialidade.destroy', $especialidades->id],'method'=>'DELETE'])!!}

    {!! Form::submit("Excluir Especialidade: $especialidades->id",['class'=>'btn btn-danger'])!!}
{!! Form::close()!!}

@endsection
