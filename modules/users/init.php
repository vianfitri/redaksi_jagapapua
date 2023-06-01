<?php

// Route Check Valid
Route::set('users_checkvalid', 'users/checkvalid(/<email>)') 
	->defaults(array(
		'controller' => 'Users',
		'action'     => 'checkValid',
	));

// Route List
Route::set('userslist', 'users/list(/<page>)')
	->defaults(array(
		'controller' => 'Users',
		'action'     => 'list',
	));

// Route Search
Route::set('userssearch', 'users/search(/<search>(/<page>))')
	->defaults(array(
		'controller' => 'Users',
		'action'     => 'search',
	));
	
// Route input
Route::set('usersinput', 'users/new(/<action>(/<page>))')
	->defaults(array(
		'controller' => 'Users',
		'action'     => 'new',
	));
	
// Route Edit
Route::set('usersedit', 'users/edit(/<id>)')
	->defaults(array(
		'controller' => 'Users',
		'action'     => 'edit',
	));
	
// Route Cahnge Password
Route::set('userscpas', 'users/cpas(/<id>)')
	->defaults(array(
		'controller' => 'Users',
		'action'     => 'cpas',
	));
	
// Route Delete
Route::set('usersdelete', 'users/delete(/<id>)')
	->defaults(array(
		'controller' => 'Users',
		'action'     => 'delete',
	));
	
// Route default
Route::set('users', 'users(/<action>(/<page>))')
	->defaults(array(
		'controller' => 'Users',
		'action'     => 'index',
	));