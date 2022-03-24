<?php

Route::group(['middleware'=>'language'],function () {
    Route::get('/home', 'ProcesosController@inicio');
    Route::get('change-password', ['as' => 'change-password', 'uses' => 'Auth\ChangePasswordController@showChangePasswordForm']);
    Route::post('change-password', ['as' => 'change-password', 'uses' => 'Auth\ChangePasswordController@change']);
    Route::get('frequent-questions', ['as' => 'frequent-questions', 'uses' => 'PreguntasController@preguntasFrecuentes']);

    //Alertas
    Route::get('alerts',['as' => 'alerts','uses' => 'AlertasController@index']);
    Route::post('alertas_vendedores/ajax_set_alerta', ['as' => 'alertas_vendedores/ajax_set_alerta', 'uses' => 'AlertasController@ajax_set_alerta']);
    Route::get('alertas_vendedores/ajax_get_alerta/{categoria_id}', ['as' => 'alertas_vendedores/ajax_get_alerta', 'uses' => 'AlertasController@ajax_get_alerta']);
    Route::post('alertas_vendedores/ajax_delete', ['as' => 'alertas_vendedores/ajax_delete', 'uses' => 'AlertasController@ajax_delete']);
    Route::post('alertas_vendedores/set_recibe_alertas', ['as' => 'alertas_vendedores/set_recibe_alertas', 'uses' => 'AlertasController@set_recibe_alertas']);

    // Configuración
    Route::get('my-accounts-settings',['as' => 'my-accounts-settings','uses' => 'UsersController@mi_cuenta_configuracion']);
    Route::post('users','UsersController@store');

    Route::get('bookmarks', ['as' => 'bookmarks', 'uses' => 'FavoritosController@bookmarks']);
    Route::get('my-purchases/{show_finished?}', ['as' => 'my-purchases', 'uses' => 'ProcesosController@misCompras']);


    //Rutas para Nueva publicación.
    Route::get('/new-auction', ['as' => 'procesos/create', 'uses' => 'ProcesosController@create']);
    Route::get('/eliminar_borrador/{proceso}', ['as' => 'eliminar_borrador', 'uses' => 'ProcesosController@eliminar_borrador']);
    Route::get('/categorias/ajax-get-subcategorias/{categoria_id}', 'CategoriasController@ajax_get_subcategorias');
    Route::post('/items/add-item', ['as' => 'items/store', 'uses' => 'ItemsController@store']);
    Route::post('procesos/ajax_set_favorito',['as' => 'ajax_set_favorito','uses' => 'FavoritosController@toogleFavorito']);
    Route::get('/edit-publication/{proceso}', ['as' => 'edit-publication', 'uses' => 'ProcesosController@edit']);
    Route::post('/procesos/store', ['as' => 'procesos.store', 'uses' => 'ProcesosController@store']);
    Route::get('procesos/view/{proceso_id}',['as' => 'procesos.view','uses' => 'ProcesosController@view']);
    Route::get('/watch-results/{proceso_id}', ['as' => 'watch-results', 'uses' => 'ProcesosController@WatchResults']);
    Route::post('/items/eliminar_item', ['as' => 'items/eliminar_item', 'uses' => 'ItemsController@delete']);
    Route::post('items/get_data_comprador',['as' => 'get_data_comprador','uses' => 'ItemsController@getDataComprador']);
    Route::post('items/get_data_vendedor',['as' => 'get_data_vendedor','uses' => 'ItemsController@getDataVendedor']);
    Route::post('finalizar_publicacion',['as' => 'finalizar_publicacion','uses' => 'ProcesosController@finalizarPublicacion']);

    //Notificaciones
    Route::post('markAllAsRead', ['as' => 'markAllAsRead', 'uses' => 'NotificationsController@markAllAsRead']);
    Route::get('notifications', ['as' => 'notifications', 'uses' => 'NotificationsController@seeAll']);

    //resume
    Route::get('/resume/{mes?}/{anio?}',['as' => 'resume','uses' => 'ResumenController@index']);
});

