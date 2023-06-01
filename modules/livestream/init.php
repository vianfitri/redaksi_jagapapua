<?php

// Route List
Route::set('livestreamlist', 'livestream/list(/<page>)')
	->defaults(array(
		'controller' => 'livestream',
		'action'     => 'list',
	));

// Route Search
Route::set('livestreamsearch', 'livestream/search(/<search>(/<page>))')
	->defaults(array(
		'controller' => 'livestream',
		'action'     => 'search',
	));
	
// Route input
Route::set('livestreaminput', 'livestream/new(/<action>(/<page>))')
	->defaults(array(
		'controller' => 'livestream',
		'action'     => 'new',
	));
	
// Route Edit
Route::set('livestreamedit', 'livestream/edit(/<id>)')
	->defaults(array(
		'controller' => 'livestream',
		'action'     => 'edit',
	));

// Route Delete
Route::set('livestreamdelete', 'livestream/delete(/<id>)')
	->defaults(array(
		'controller' => 'livestream',
		'action'     => 'delete',
	));
	
// Route default
Route::set('livestream', 'livestream(/<action>(/<page>))')
	->defaults(array(
		'controller' => 'livestream',
		'action'     => 'index',
	));