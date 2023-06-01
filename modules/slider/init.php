<?php

// Route List
Route::set('sliderlist', 'slider/list(/<page>)')
	->defaults(array(
		'controller' => 'slider',
		'action'     => 'list',
	));

// Route Search
Route::set('slidersearch', 'slider/search(/<search>(/<page>))')
	->defaults(array(
		'controller' => 'slider',
		'action'     => 'search',
	));
	
// Route input
Route::set('sliderinput', 'slider/new(/<action>(/<page>))')
	->defaults(array(
		'controller' => 'slider',
		'action'     => 'new',
	));
	
// Route Edit
Route::set('slideredit', 'slider/edit(/<id>)')
	->defaults(array(
		'controller' => 'slider',
		'action'     => 'edit',
	));
	
// Route Cahnge Password
Route::set('slidercpas', 'slider/cpas(/<id>)')
	->defaults(array(
		'controller' => 'slider',
		'action'     => 'cpas',
	));
	
// Route Delete
Route::set('sliderdelete', 'slider/delete(/<id>)')
	->defaults(array(
		'controller' => 'slider',
		'action'     => 'delete',
	));
	
// Route default
Route::set('slider', 'slider(/<action>(/<page>))')
	->defaults(array(
		'controller' => 'slider',
		'action'     => 'index',
	));