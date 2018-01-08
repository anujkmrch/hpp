<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tests', function()
{
	// print_r(json_decode('{"menu":{"title":"Select menu","type":"select","validations":["not_empty"],"callback":"menu_list_build","scope":"configuration","multiple":false,"required":true}}',true));
	event('auth.onLogin');

	$widget = [
	    		'title'=> 'Menu',
	    		'slug'=>'system_menu',
	    		'description'=>'This is the default system menu widget',
	    		'enabled'=>true,
	    		'configuration'=>[
	    						'menu' =>[
									'title' => 'Select menu',
									'type' => 'select',
									'validations' => ['not_empty'],
									'callback' => 'menu_list_build',
									'scope' => 'configuration',
									'multiple' => false, 
									'required' => true 
								],
							],
				'path' => 'Widgets',
			];

	$w = new \System\Models\Widget($widget);
	// $w->save();
	// event('order.onCreated','well');
});

