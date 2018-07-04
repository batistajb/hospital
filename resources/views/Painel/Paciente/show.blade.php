@extends('Painel.templates.template')

@section('conteudo')

<h1 class='title-pg'>    
    <a href="{{route('paciente.index')}}">​<span class="glyphicon glyphicon-arrow-left">Voltar</span></a>
    Paciente: <b>{{$paciente->nome}}</b>
</h1>

<p><b>Data de Nascimento:</b> {{$paciente->datanasc}}</p>
<p><b>Sexo:</b> {{$paciente->sexo}}</p>
<p><b>CNS:</b> {{$paciente->CNS}}</p>
<p><b>Endereço:</b> {{$paciente->endereco}}</p>
<p><b>Bairro:</b> {{$paciente->bairro}}</p>
<p><b>Municipio:</b> {{$paciente->municipio}}</p>
<p><b>Contato:</b> {{$paciente->contato}}</p>

<hr>

@if(isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

{!! Form::open(['route'=>['paciente.destroy', $paciente->id],'method'=>'DELETE'])!!}

    {!! Form::submit("Excluir Paciente: $paciente->nome",['class'=>'btn btn-danger'])!!}
{!! Form::close()!!}

@endsection
