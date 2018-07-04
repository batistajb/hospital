


<?php


Auth::routes();

//Route::get('/painel/produtos/tests','Painel\ProdutoController@tests');
//Route::resource('/painel/produtos','Painel\ProdutoController');

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'],function(){
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
  //  Route::resource('/Site/home','Site\SiteController');
    Route::resource('/painel/paciente','Painel\PacienteController');
    Route::resource('/painel/especialidade','Painel\EspecialidadeController');
    Route::resource('/painel/medico','Painel\MedicoController');
    Route::resource('/painel/exame','Painel\ExameController');
    Route::resource('/painel/tecnico','Painel\TecnicoController');
    Route::resource('/painel/agendarexame','Painel\AgendaDeExamesController');
    Route::resource('/painel/usuario','Painel\UsuarioController');     
    Route::get('exame{id}','Painel\AgendaDeExamesController@getPdf')->name('PDF-agenda-exame');  
    Route::resource('/painel/agendarconsulta','Painel\AgendaDeConsultasController');    
    Route::get('consulta{id}','Painel\AgendaDeConsultasController@getPdf')->name('PDF-agenda-consulta');
    Route::get('/painel/agendarconsulta/esp/{id}','Painel\AgendaDeConsultasController@getEspecialidades');   
    //Route::get('/painel/agendarconsulta/esp/{id}','Painel\AgendaDeConsultasController@getEspecialidades   
    Route::post('/painel/relatorioexame','Painel\RelatorioDeExamesController@store')->name('relatorioexame.index');
    Route::get('/painel/relatorioexame','Painel\RelatorioDeExamesController@index');
    Route::post('/painel/relatorioconsulta','Painel\RelatorioDeConsultasController@store')->name('relatorioconsulta.index');
    Route::get('/painel/relatorioconsulta','Painel\RelatorioDeConsultasController@index');
    Route::get('/painel/relatoriofeedback','Painel\RelatorioDeFeedBacksController@index');    
    Route::get('relatorio-consulta','Painel\RelatorioDeConsultasController@getPdf')->name('PDF-relatorio-consulta');
    Route::post('/painel/feedback','Painel\RelatorioDeFeedBacksController@store')->name('feedback.store');
    Route::get('/painel/feedback','Painel\RelatorioDeFeedBacksController@index')->name('feedback.index');
    //Route::get('get-especialiades/{medico_id}','Painel\AgendaDeConsultasController@getEspecialidades')->name('test');
    Route::get('/painel/relatoriofeedback','Painel\RelatorioDeFeedBacksController@relatorio')->name('relatoriofeedback.index');
    Route::post('/painel/relatoriofeedback','Painel\RelatorioDeFeedBacksController@relatorioStore')->name('relatoriofeedback.store');    
    //Rota para ajax-dashboard
    Route::get('dashboard/ajax-line-chart','HomeController@chart')->name('lineChart');//ajax
    Route::get('dashboard/calendar','HomeController@calendar')->name('calendar');//ajax
    Route::get('dashboard/consultas','HomeController@agendamentosConsultas')->name('agendamentosConsultas');//ajax 
});

