@extends('Painel.templates.template')

@section('conteudo')

<h1 Class="title-pg">
    Formulário de Agendamentos: <b>{{$medicos->nome or 'Agendar'}}</b>
</h1>
<h3><a href="{{route('agendarconsulta.index')}}">​<i class="glyphicon glyphicon-arrow-left"></i>Voltar</a></h3>


@if(isset($errors) && count($errors) > 0)
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
    <p>{{$error}}</p>
    @endforeach
</div>
@endif


{!! Form::open(['route'=> 'agendarconsulta.store','class' => 'form']) !!}

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

            <label>Nome do Medico: </label>
            <select name="medico_id" class="form-control">
                <option></option>
                @foreach($medicos as $medico)
                <option value="{{$medico->id}}">{{$medico->nome}}</option>
                @endforeach
            </select>      

        </div>
            
        <div class="col-sm-6">
            <label>Nome da Especialidade: </label>       
            <select name="especialidade_id" class="form-control" >                
            </select>
        </div>       
        
        <div class="col-sm-6">
            <label>Data da Consulta: </label>
            {!! Form::Date('data_consulta',null,['class'=>'form-control']) !!}

        </div>

        <div class="col-sm-6">
            <label>Hora da Consulta: </label>
            {!! Form::Time('hora_consulta',null,['class'=>'form-control']) !!}   <br>
        </div>
<br>  
            <input type="hidden" name="usuario_id" value="{{$usuarios->id}}"/>
             
        <div class="col-sm-6">
            <br>
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


 <script type="text/javascript">
 $('select[name=medico_id]').change(function () {
            var id = $(this).val();
            /*requisição na tabela das grades*/
            $.get('esp/' + id, function (especialidade) {
                $('select[name=especialidade_id]').empty();
                $.each(especialidade, function (key, value) {
                    $('select[name=especialidade_id]').append('<option value=' + value.id + '>' + value.nome + '</option>');
                });
            });
        });
 
 </script>

@endsection