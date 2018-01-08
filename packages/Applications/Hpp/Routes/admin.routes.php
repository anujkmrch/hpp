<?php
Route::group(['prefix'=>'admin','namespace'=>"Hpp\Apps\Admin\Controllers"],function(){

	Route::get('/applications',[
		'uses' => 'ApplicationController@index',
		'as'   => 'hpp.admin.index',
	]);

	Route::get('/applicationsds',[
		'uses' => 'ApplicationController@index',
		'as'   => 'hpp.admin.attendance.index',
	]);

});
?>