@extends('Painel.templates.template')

@section('conteudo')

<h1 class='title-pg'>    
    <a href="{{route('usuario.index')}}">​<span class="glyphicon glyphicon-arrow-left">Voltar</span></a>
    Usuário: <b>{{$usuario->name}}</b>
</h1>
<br>
<p><b>Nome do Usuário:</b> {{$usuario->name}}</p>
<hr>

@if(isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

{!! Form::open(['route'=>['usuario.destroy', $usuario->id],'method'=>'DELETE'])!!}
    {!! Form::submit("Excluir Usuário: $usuario->id",['class'=>'btn btn-danger'])!!}
{!! Form::close()!!}

@endsection
