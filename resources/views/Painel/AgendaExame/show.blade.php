@extends('Painel.templates.template')

@section('conteudo')

<h1 class='title-pg'>    
    <a href="{{route('agendarexame.index')}}">​<span class="glyphicon glyphicon-arrow-left">Voltar</span></a>
    Agendamentos: <b>{{$agenda->paciente->nome}}</b>
    
<hr>

</h1>
<p><b>Paciente:</b> {{$agenda->paciente->nome}}</p>
<p><b>Exame:</b> {{$agenda->exame->nome}}</p>
<p><b>Técnico Responsável:</b> {{$agenda->tecnico->nome}}</p>
<p><b>Data do Exame</b> {{$agenda->data_exame}}</p>
<p><b>Hora do Exame</b> {{$agenda->hora_exame}}</p>


<hr>

@if(isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

{!! Form::open(['route'=>['agendarexame.destroy', $agenda->id],'method'=>'DELETE'])!!}

{!! Form::submit("Excluir Agendamento: $agenda->id",['class'=>'btn btn-danger'])!!}
    
{!! Form::close()!!}

@endsection
