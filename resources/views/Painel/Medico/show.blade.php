@extends('Painel.templates.template')

@section('conteudo')

<h1 class='title-pg'>    
    <a href="{{route('medico.index')}}">​<span class="glyphicon glyphicon-arrow-left">Voltar</span></a>
    Médico: <b>{{$medico->nome}}</b>
</h1>
<p><b>Nome do Médico:</b> {{$medico->nome}}</p>
<p><b>Especialide(s):</b>@foreach ($medico->especialidades as $medico)
    {{$medico->nome.','}}@endforeach</p>
<hr>
@if(isset($errors) && count($errors) > 0)
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
    <p>{{$error}}</p>
    @endforeach
</div>
@endif

{!! Form::open(['route'=>['medico.destroy', $medico->id],'method'=>'DELETE'])!!}

{!! Form::submit("Excluir Médico: $medico->id",['class'=>'btn btn-danger'])!!}
{!! Form::close()!!}

@endsection
