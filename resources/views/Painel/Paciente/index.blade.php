@extends('painel.templates.template')

@section('conteudo')

<h1 class='title-pg'>Listagem dos Pacientes</h1>
<a href="{{route('paciente.create')}}" class="btn btn-primary btn-add"><span class="glyphicon glyphicon-plus"></span>Cadastrar</a>

<div class="form-group" id="mensagem" >
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}                
    </div>
    @endif
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function () {
            $('#mensagem').fadeOut(1500);
        }, 2000);
    });
    
</script>

<table class="table table-hover">
    <tr>
        <th>Nome</th>
        <th>Data de Nascimento</th>
        <th>Sexo</th>
        <th width="100px">Ações</th>
    </tr>     
        @foreach($pacientes as $paciente)
    <tr>
        <td>{{$paciente->nome}}</td>
        <td>{{$paciente->datanasc->format('d/m/y')}}</td>
        <td>{{$paciente->sexo}}</td>
        <td>
            <a href="{{route('paciente.edit',$paciente->id)}}" class='actions edit'>
                
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <a href="{{route('paciente.show',$paciente->id)}}" class='actions delete'>
                <span class="glyphicon glyphicon-zoom-in"></span>
            </a>           
        </td>
    </tr>
        @endforeach
    
</table>
    
    {!! $pacientes->links()!!}
    
@endsection
