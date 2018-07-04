@extends('Painel.templates.template')

@section('conteudo')

<h1 Class="title-pg">
    Formulário de Médicos: <b>{{$medico->nome or 'Cadastrar'}}</b>
</h1>
<h3><a href="{{route('medico.index')}}">​<i class="glyphicon glyphicon-arrow-left"></i>Voltar</a></h3>


@if(isset($errors) && count($errors) > 0)
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
    <p>{{$error}}</p>
    @endforeach
</div>
@endif

@if(isset($medico))
{!!Form::model($medico, ['route'=>['medico.update',$medico->id],'class' =>'form', 'method'=>'put'])!!}
@else
{!! Form::open(['route'=> 'medico.store','class' => 'form']) !!}
@endif
<div class="form-group">
    {!! Form::text('nome',null,['class'=>'form-control','placeholder'=>'Nome:']) !!}
</div>  

<div class="form-group">

    <label>Especialidade</label>


    <select name="esp[]" class="select-especialidades form-control " multiple="multiple">
        @foreach($esps as $esp)
        <option value="{{$esp->id}}">{{$esp->nome}}</option>
        @endforeach
    </select>      



</div>

{!!form::submit('Cadastrar',['class'=>'btn btn-primary'])!!}

</form>

<script type="text/javascript">
        $(document).ready(function() {
            $('.select-especialidades').select2({
                placeholder: "Selecione as especialidades...",
                allowClear:"true",
                minimumInputLength:1
            });      
        });
    </script>


@endsection