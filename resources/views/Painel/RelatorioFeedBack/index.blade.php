@extends('painel.templates.template')

@section('conteudo')

<h1 class='title-pg'>FEED BACK DO PACIENTE</h1>


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


{!! Form::open(['route'=> 'feedback.store','class' => 'form']) !!}

<div class="col-sm-4">
    <label>Em uma escala de 1 a 5 qual a qualidade geral do atendimento nesta unidade?</label>
    <div class="radio">
      <label><input type="radio" name="pessimo" value="1">1. Péssima</label>
    </div>
    <div class="radio">
      <label><input type="radio" name="ruim" value="2">2. Ruim</label>
    </div>
    <div class="radio">
      <label><input type="radio" name="regular" value="3">3. Regular</label>
    </div>
    <div class="radio">
      <label><input type="radio" name="bom" value="4">4. Boa</label>
    </div>
    <div class="radio">
      <label><input type="radio" name="otimo" value="5">5. Ótima</label>
    </div>   

    <hr>
 {!!form::submit('Enviar',['class'=>'btn btn-primary'])!!}
</div>

{!!form::close()!!}
@endsection
