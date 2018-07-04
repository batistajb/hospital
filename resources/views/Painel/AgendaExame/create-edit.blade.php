@extends('Painel.templates.template')

@section('conteudo')

<h1 Class="title-pg">
    Formulário de Agendamentos: <b>{{$exames->nome or 'Agendar'}}</b>
</h1>
<h3><a href="{{route('agendarexame.index')}}">​<i class="glyphicon glyphicon-arrow-left"></i>Voltar</a></h3>


@if(isset($errors) && count($errors) > 0)
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
    <p>{{$error}}</p>
    @endforeach
</div>

@endif

@if(isset($agenda))
{!!Form::model($agenda, ['route'=>['agendarexame.update',$agenda->id],'class' =>'form', 'method'=>'put'])!!}
@else
{!! Form::open(['route'=> 'agendarexame.store','class' => 'form']) !!}
@endif


<div class="form-group">

    <div class="row">  
        <div class="col-sm-6">                                   
            <label>Nome do Paciente: </label>
            <select name="paciente_id" class="form-control">
                @foreach($pacientes as $paciente)
                <option value="{{$paciente->id}}">{{$paciente->nome}}</option>
                @endforeach
            </select>      
        </div>

        <div class="col-sm-6">
       <label>Nome do Exame: </label>

            <select name="exame_id" class="form-control">
                @foreach($exames as $exame)
                <option value="{{$exame->id}}">{{$exame->nome}}</option>
                @endforeach
            </select>      

        </div>
            

        <div class="col-sm-6">

            <label>Nome do Técnico: </label>

            <select name="tecnico_id" class="form-control">
                @foreach($tecnicos as $tecnico)
                <option value="{{$tecnico->id}}">{{$tecnico->nome}}</option>
                @endforeach
            </select>      
        </div>

        <div class="col-sm-6">
            <label>Data do Exame: </label>
            {!! Form::Date('data_exame',null,['class'=>'form-control']) !!}

        </div>

        <div class="col-sm-6">
            <label>Hora do Exame: </label>
            {!! Form::Time('hora_exame',null,['class'=>'form-control']) !!}      
        </div>

        <div class="col-sm-6">
            <input type="hidden" name="usuario_id" value="{{$usuarios->id}}"/><br>
        </div>

        <div class="col-sm-6">
            {!!form::submit('Agendar',['class'=>'btn btn-primary'])!!}
        </div>
        </form>
    </div>
</div>

@if(session('status'))
<script>
    confirm("{{session('status')}}");
</script>
@endif


@endsection