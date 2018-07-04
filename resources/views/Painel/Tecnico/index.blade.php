@extends('painel.templates.template')

@section('conteudo')

<h1 class='title-pg'>Listagem dos Tecnicos</h1>
<a href="{{route('tecnico.create')}}" class="btn btn-primary btn-add"><span class="glyphicon glyphicon-plus"></span>Cadastrar</a>

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
        <th width="100px">Ações</th>
    </tr>     
        @foreach($tecnicos as $tecnico)
    <tr>
        <td>{{$tecnico->nome}}</td>
        <td>
            <a href="{{route('tecnico.edit',$tecnico->id)}}" class='actions edit'>
                
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <a href="{{route('tecnico.show',$tecnico->id)}}" class='actions delete'>
                <span class="glyphicon glyphicon-zoom-in"></span>
            </a>           
        </td>
    </tr>
        @endforeach
    
</table>
    
    {!! $tecnicos->links()!!}
    
@endsection
