@extends('Painel.templates.template')

@section('conteudo')

<h1 Class="title-pg">
    Formulário de Usuarios: <b>{{$usuario->nome or 'Cadastrar'}}</b>
</h1>
<h3><a href="{{route('usuario.index')}}">​<i class="glyphicon glyphicon-arrow-left"></i>Voltar</a></h3>

@if(isset($errors) && count($errors) > 0)
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
    <p>{{$error}}</p>
    @endforeach
</div>
@endif

<div class="form-group" id="mensagem" >
    @if (session('status'))
    <div class="alert alert-danger">
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

@if(isset($usuario))
{!!Form::model($usuario, ['route'=>['usuario.update',$usuario->id],'class' =>'form', 'method'=>'put'])!!}
@else
{!! Form::open(['route'=> 'usuario.store','class' => 'form']) !!}
@endif

<div class="form-group">
    
     <div class="col-sm-4">
        {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Nome do Usuário:']) !!}<br>
     </div>
    <div class="col-sm-4">
        {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Email do Usuário:']) !!}<br>
    </div>
    
     <div class="col-md-8">
        <label>Tipo de Acesso: </label>
        <select name="acesso" class="form-control">
           <option value="0">Administrador</option>
           <option value="1">Recepcionista</option>
       </select>      
        <br>
     </div>   
      <div class="col-md-6">  
        <label>Digite uma senha:</label>
        {!! Form::password('password',null,['class'=>'form-control','placeholder'=>'Senha do Usuário:']) !!} <br>
        <label>Confirme a senha:</label>
        {!! Form::password('password1',null,['class'=>'form-control','placeholder'=>'Senha do Usuário:']) !!}
        <br>
     </div> 
     

     <div class="col-sm-12">
             <br>
        {!!form::submit('Cadastrar',['class'=>'btn btn-primary'])!!}
    </div>
</form>

@endsection

