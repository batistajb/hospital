@extends('Painel.templates.template')

@section('conteudo')

<h1 class='title-pg'>    
    <a href="{{route('agendarconsulta.index')}}">​<span class="glyphicon glyphicon-arrow-left">Voltar</span></a>
    Agendamentos: <b>{{$agenda->paciente->nome}}</b>

</h1>
<p><b>Paciente:</b> {{$agenda->paciente->nome}}</p>
<p><b>Medico:</b> {{$agenda->medico->nome}}</p>

<p><b>Especialidade:@foreach($especialidade as $esp)</b> {{$esp.', '}}
    @endforeach <b></b></p>
<p><b>Data da Consulta</b> {{$agenda->data_consulta}}</p>
<p><b>Hora da Consulta</b> {{$agenda->hora_consulta}}</p>
<hr>

@if(isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>

@endif

{!! Form::open(['route'=>['agendarconsulta.destroy', $agenda->id],'method'=>'DELETE'])!!}

    {!! Form::submit("Excluir Agendamento: $agenda->id",['class'=>'btn btn-danger'])!!}
{!! Form::close()!!}

@endsection
