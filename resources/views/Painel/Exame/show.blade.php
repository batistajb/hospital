@extends('Painel.templates.template')

@section('conteudo')

<h1 class='title-pg'>    
    <a href="{{route('exame.index')}}">​<span class="glyphicon glyphicon-arrow-left">Voltar</span></a>
    Exame: <b>{{$exame->nome}}</b>
</h1>
<br>
<p><b>Nome do Exame:</b> {{$exame->nome}}</p>
<hr>

@if(isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

{!! Form::open(['route'=>['exame.destroy', $exame->id],'method'=>'DELETE'])!!}

    {!! Form::submit("Excluir Exame: $exame->id",['class'=>'btn btn-danger'])!!}
{!! Form::close()!!}

@endsection
