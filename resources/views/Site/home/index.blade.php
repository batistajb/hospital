@extends('painel.templates.template')

@section('style')

@endsection

@section('conteudo')

<hr/>
<section class="container">
    <div class="row">
        <div class="col-md-12">      
            <div class="col-md-4 ">
                <div class="panel panel-default">
                    <div class="panel-heading">Feedback - Qualidade do Atendimento</div>
                    <canvas id="pizza"  height="300"></canvas>
                </div>
            </div> 
            
            <div class="col-md-8 ">
                <div class="panel panel-default">
                    <div class="panel-heading">Agendamentos</div>
                    <canvas id="line"  height="143"></canvas>
                </div>
            </div>     
             
          </div> 
    </div>

</section>
<!-- <div id='top'>

    Locales:
    <select id='locale-selector'></select>

  </div>

  <div id='calendar'></div>-->

<script>

    $.ajax({
    url: 'dashboard/consultas',
            success: function (response) {
          
            var consultashoje = 0;
            var especialidade = [];
            var especialidadenome = [];
            var dataAtual = new Date();
            
            
      
         
            //Carrega  5 dias a partir da data atual
            var diaAtual = dataAtual.getDate();
            var diaAtual2 = diaAtual+1;
            var diaAtual3 = diaAtual2+1;
            var diaAtual4 = diaAtual3+1;
            var diaAtual5 = diaAtual4+1;          
            var mesAtual = dataAtual.getMonth()+1;
            var anoAtual = dataAtual.getFullYear();
            
               
            console.log(mesAtual);
        
            
        
            var data    =   anoAtual + "-0" + mesAtual  + "-0" + diaAtual;
            var data2   =   anoAtual + "-0" + mesAtual  + "-0" + diaAtual2;
            var data3   =   anoAtual + "-0" + mesAtual  + "-0" + diaAtual3;
            var data4   =   anoAtual + "-0" + mesAtual  + "-0" + diaAtual4;
            var data5   =   anoAtual + "-0" + mesAtual  + "-0" + diaAtual5;

            
            //array para salvar a qtd de consultas do dia
             var consultashoje = [[0],[0],[0],[0],[0]];
              //array para salvar a qtd de exames do dia
             var exameshoje = [[0],[0],[0],[0],[0]];
             var cont=0;
         
       
        
//            laços para pecorrer as consultas


              var cont=0,cont1=0,cont2=0,cont3=0,cont4=0;
              
                    for (var i = 0; i < response.consultas.length; i++) {
                        if ((response.consultas[i].data_consulta) == data) {
                                     cont=cont+1;
                        }
                        console.log(response.consultas[i].data_consulta);
                        console.log(data);
                    }
                    consultashoje[0]=cont;             
                    

                    for (var i = 0; i < response.consultas.length; i++) {
                        if ((response.consultas[i].data_consulta) == data2) {
                                   cont1=cont1+1;                   
                                                           
                        }                                             
                    }
                    consultashoje[1]=cont1;
                    
                    for (var i = 0; i < response.consultas.length; i++) {
                        if ((response.consultas[i].data_consulta) == data3) { 
                            cont2=cont2+1; 
                                                       
                        }                        
                    }
                     consultashoje[2]=cont2;   
                    
                    for (var i = 0; i < response.consultas.length; i++) {
                        if ((response.consultas[i].data_consulta) == data4) { 
                            cont3=cont3+1; 
                                                         
                        }   
                    }
                    consultashoje[3]=cont3; 
                    
                   
                    for (var i = 0; i < response.consultas.length; i++) {
                        if ((response.consultas[i].data_consulta) == data5) {                             
                                cont4=cont4+1;                
                                                         
                        }                                          
                    }
                    consultashoje[4]=cont4;  
                    

                  //lacos para pecorrer os exames
                  
                  var cont=0,cont1=0,cont2=0,cont3=0,cont4=0;
                      for (var i = 0; i < response.exames.length; i++) {
                        if ((response.exames[i].data_exame) == data) { 
                           cont=cont+1;                                                           
                        }                                          
                    }
                    exameshoje[0]=cont;
                  
                    for (var i = 0; i < response.exames.length; i++) {
                        if ((response.exames[i].data_exame) == data2) {                            
                                cont1=cont1+1;
                                                        
                        }                                             
                    }                    
                    exameshoje[1]=cont1;
                    
                    for (var i = 0; i < response.exames.length; i++) {
                        if ((response.exames[i].data_exame) == data3) { 
                                 cont2=cont2+1;
                                                       
                        }                        
                    }
                   exameshoje[2]=cont2;
                    for (var i = 0; i < response.exames.length; i++) {
                        if ((response.exames[i].data_exame) == data4) { 
                                 cont3=cont3+1;
                                                         
                        }   
                    }
                   exameshoje[3]=cont3;
                   
                    for (var i = 0; i < response.exames.length; i++) {
                        if ((response.exames[i].data_exame) == data5) { 
                                cont4=cont4+1;                                                 
                        }                                          
                    }
                    exameshoje[4]=cont4;


                data = data.split('-').reverse().join('-');
                data2 = data2.split('-').reverse().join('-');
                data3 = data3.split('-').reverse().join('-');
                data4 = data4.split('-').reverse().join('-');
                data5 = data5.split('-').reverse().join('-');


            //plotagem do grafico      
            var ctx = document.getElementById('line').getContext('2d');
            var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',
                    // The data for our dataset
                    
                      
                    
                     data: {
                            labels: [data,data2,data3,data4,data5],
                            datasets: 
                                [{
                                    label: 'Consultas',
                                    data: consultashoje,
                                    backgroundColor: [
                                        '#A9A9F5'                                   
                                    ],
                                    borderColor: [
                                        '#424242'
                                    ],
                                    borderWidth: 1
                                },
                                {
                                    label: 'Exames',
                                    data: exameshoje,
                                    backgroundColor: [
                                        '#F6CEF5'                                   
                                    ],
                                    borderColor: [
                                        '#424242'
                                    ],
                                    borderWidth: 1
                                }
                     ]},
                        
                    options: {
                    title: {
                    display: true,
                            text: 'Agendamentos da Semana',
                            fontSize: '20'
                        }
                    }
                });
              }
           });
      
</script>
<script>

    $.ajax({
    url: 'dashboard/ajax-line-chart',
            success: function (response) {
            var label = [];
            var pessimo = 0;
            var ruim = 0;
            var regular = 0;
            var bom = 0;
            var otimo = 0;
            for (var i = 0; i < response.length; i++) {
            if ((response[i].pessimo) == 1) {
            pessimo++;
            }
            if ((response[i].ruim) == 2) {
            ruim++;
            }
            if ((response[i].regular) == 3) {
            regular++;
            }
            if ((response[i].bom) == 4) {
            bom++;
            }
            if ((response[i].otimo) == 5) {
            otimo++;
            }
            }

            var ctx = document.getElementById('pizza').getContext('2d');
            var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'pie',
                    // The data for our dataset
                    data: {
                    labels: ["Péssimo", "Ruim", "Regular", "Bom", "Ótimo"],
                            datasets: [{
                            backgroundColor: ['rgb(255,0,0)', 'rgb(255, 99, 132)', 'rgb(255,215,0)', 'rgb(127,255,212)', 'rgb(0,255,0)'],
                                    //borderColor: 'rgb(255, 99, 132)',
                                    data: [pessimo, ruim, regular, bom, otimo]
                            }]
                    },
                    // Configuration options go here
                    options: {
                    title: {
                    display: true,
                            text: 'Fedeback Pacientes',
                            fontSize: '20'
                    }
                    }
            });
         }
    });



</script>


@section('script')


@endsection
@endsection



<!--
<script>
   
  $(document).ready(function() {
    var initialLocaleCode = 'en';

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listMonth'
      },
      defaultDate: '2018-03-12',
      locale: initialLocaleCode,
      buttonIcons: false, // show the prev/next text
      weekNumbers: true,
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
        {
          title: 'All Day Event',
          start: '2018-03-01'
        },
        {
          title: 'Long Event',
          start: '2018-03-07',
          end: '2018-03-10'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2018-03-09T16:00:00'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2018-03-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2018-03-11',
          end: '2018-03-13'
        },
        {
          title: 'Meeting',
          start: '2018-03-12T10:30:00',
          end: '2018-03-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2018-03-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2018-03-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2018-03-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2018-03-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2018-03-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2018-03-28'
        }
      ]
    });

    // build the locale selector's options
    $.each($.fullCalendar.locales, function(localeCode) {
      $('#locale-selector').append(
        $('<option/>')
          .attr('value', localeCode)
          .prop('selected', localeCode == initialLocaleCode)
          .text(localeCode)
      );
    });

    // when the selected option changes, dynamically change the calendar option
    $('#locale-selector').on('change', function() {
      if (this.value) {
        $('#calendar').fullCalendar('option', 'locale', this.value);
      }
    });
  });
</script>-->