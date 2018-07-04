@extends('Painel.templates.template')

@section('conteudo')

<h1 class='title-pg'>    
    <a href="{{route('tecnico.index')}}">​<span class="glyphicon glyphicon-arrow-left">Voltar</span></a>
    Técnico: <b>{{$tecnico->nome}}</b>
</h1>
<br>
<p><b>Nome do Técnico:</b> {{$tecnico->nome}}</p>
<hr>

@if(isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

{!! Form::open(['route'=>['tecnico.destroy', $tecnico->id],'method'=>'DELETE'])!!}

    {!! Form::submit("Excluir Tecnico: $tecnico->id",['class'=>'btn btn-danger'])!!}
{!! Form::close()!!}

@endsection
