<?php

// Route List
Route::set('mascatlist', 'mascat/list(/<page>)')
	->defaults(array(
		'controller' => 'mascat',
		'action'     => 'list',
	));

// Route Search
Route::set('mascatsearch', 'mascat/search(/<search>(/<page>))')
	->defaults(array(
		'controller' => 'mascat',
		'action'     => 'search',
	));
	
// Route input
Route::set('mascatinput', 'mascat/new(/<action>(/<page>))')
	->defaults(array(
		'controller' => 'mascat',
		'action'     => 'new',
	));
	
// Route Edit
Route::set('mascatedit', 'mascat/edit(/<id>)')
	->defaults(array(
		'controller' => 'mascat',
		'action'     => 'edit',
	));
	
// Route Cahnge Password
Route::set('mascatcpas', 'mascat/cpas(/<id>)')
	->defaults(array(
		'controller' => 'mascat',
		'action'     => 'cpas',
	));
	
// Route Delete
Route::set('mascatdelete', 'mascat/delete(/<id>)')
	->defaults(array(
		'controller' => 'mascat',
		'action'     => 'delete',
	));
	
// Route default
Route::set('mascat', 'mascat(/<action>(/<page>))')
	->defaults(array(
		'controller' => 'mascat',
		'action'     => 'index',
	));