<?php

use Illuminate\Http\Request;

\ApiRoute::version('v1',function() {
    ApiRoute::group([
        'namespace' => 'App\Http\Controllers',
        'as' => 'api',
        'middleware' => 'bindings' //TODO middleware que permite a passagem de parametros entre os eventos pelo routeApi
    ], function () {
        ApiRoute::get('/', function () {
            return 'home api';
        });

        ApiRoute::group(['as' =>'venda','prefix' => 'venda'],function(){
            ApiRoute::get('/', 'VendaController@index')->name('venda.index');
            ApiRoute::get('{vendedor}/lista', 'VendaController@lista')->name('venda.lista');
            ApiRoute::post('/', 'VendaController@store')->name('venda.store');
        });

        ApiRoute::group(['as' =>'vendedor','prefix' => 'vendedor'],function(){
            ApiRoute::get('/', 'VendedorController@index')->name('vendedor.index');
            ApiRoute::get('/lista', 'VendedorController@lista')->name('vendedor.lista');
            ApiRoute::get('/{vendedor}/edit', function(\App\Models\Vendedor $vendedor){
                return $vendedor;
            })->name('vendedor.edit');
            ApiRoute::put('/{vendedor}', 'VendedorController@update')->name('vendedor.update');
            ApiRoute::post('/', 'VendedorController@store')->name('vendedor.store');
        });


        ApiRoute::get('send', function(){
            if(env('MAIL_HOST') && env('MAIL_USERNAME')){
                \Illuminate\Support\Facades\Artisan::call('send:relatorio');
                return response(["message" => "Sucesso"]);
            }
            throw new \App\Exceptions\PolicyException("Antes de enviar as notificações, deve ser adicionado as configuraçẽs de smtp no arquivo .env da api");
        })->name('send.notification');

    });

});


