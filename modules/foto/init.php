<?php

// Route Category List
Route::set('foto_category_list', 'foto/category/list(/<page>)')
	->defaults(array(
		'controller' => 'foto',
		'action'     => 'categoryList',
	));
	
// Route Category New
Route::set('foto_category_new', 'foto/category/new')
	->defaults(array(
		'controller' => 'foto',
		'action'     => 'categoryNew',
	));
	
// Route Category Submit
Route::set('foto_category_submit', 'foto/category/submit')
	->defaults(array(
		'controller' => 'foto',
		'action'     => 'categorySubmit',
	));
	
// Route Category Edit
Route::set('foto_category_edit', 'foto/category/edit(/<id>)')
	->defaults(array(
		'controller' => 'foto',
		'action'     => 'categoryEdit',
	));
	
// Route Category Update
Route::set('foto_category_update', 'foto/category/update')
	->defaults(array(
		'controller' => 'foto',
		'action'     => 'categoryUpdate',
	));
	
// Route Category Delete
Route::set('foto_category_delete', 'foto/category/delete(/<id>)')
	->defaults(array(
		'controller' => 'foto',
		'action'     => 'categoryDelete',
	));
	
// Route Category Search
Route::set('foto_category_search', 'foto/category/search(/<search>(/<page>))')
	->defaults(array(
		'controller' => 'foto',
		'action'     => 'categorySearch',
	));

// Route List
Route::set('foto_list', 'foto/list(/<page>)')
	->defaults(array(
		'controller' => 'foto',
		'action'     => 'list',
	));

// Route Search
Route::set('foto_search', 'foto/search(/<search>(/<page>))')
	->defaults(array(
		'controller' => 'foto',
		'action'     => 'search',
	));
	
// Route input
Route::set('foto_input', 'foto/new(/<action>(/<page>))')
	->defaults(array(
		'controller' => 'foto',
		'action'     => 'new',
	));
	
// Route Edit
Route::set('foto_edit', 'foto/edit(/<id>)')
	->defaults(array(
		'controller' => 'foto',
		'action'     => 'edit',
	));
	
// Route Delete
Route::set('foto_delete', 'foto/delete(/<id>)')
	->defaults(array(
		'controller' => 'foto',
		'action'     => 'delete',
	));
	
// Route default
Route::set('foto', 'foto(/<action>(/<page>))')
	->defaults(array(
		'controller' => 'foto',
		'action'     => 'index',
	));