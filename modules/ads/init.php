<?php

// Route Category List
Route::set('ads_category_list', 'ads/category/list(/<page>)')
	->defaults(array(
		'controller' => 'ads',
		'action'     => 'categoryList',
	));
	
// Route Category New
Route::set('ads_category_new', 'ads/category/new')
	->defaults(array(
		'controller' => 'ads',
		'action'     => 'categoryNew',
	));
	
// Route Category Submit
Route::set('ads_category_submit', 'ads/category/submit')
	->defaults(array(
		'controller' => 'ads',
		'action'     => 'categorySubmit',
	));
	
// Route Category Edit
Route::set('ads_category_edit', 'ads/category/edit(/<id>)')
	->defaults(array(
		'controller' => 'ads',
		'action'     => 'categoryEdit',
	));
	
// Route Category Update
Route::set('ads_category_update', 'ads/category/update')
	->defaults(array(
		'controller' => 'ads',
		'action'     => 'categoryUpdate',
	));
	
// Route Category Delete
Route::set('ads_category_delete', 'ads/category/delete(/<id>)')
	->defaults(array(
		'controller' => 'ads',
		'action'     => 'categoryDelete',
	));
	
// Route Category Search
Route::set('ads_category_search', 'ads/category/search(/<search>(/<page>))')
	->defaults(array(
		'controller' => 'ads',
		'action'     => 'categorySearch',
	));

// Route List
Route::set('ads_list', 'ads/list(/<page>)')
	->defaults(array(
		'controller' => 'ads',
		'action'     => 'list',
	));

// Route Search
Route::set('ads_search', 'ads/search(/<search>(/<page>))')
	->defaults(array(
		'controller' => 'ads',
		'action'     => 'search',
	));
	
// Route input
Route::set('ads_input', 'ads/new(/<action>(/<page>))')
	->defaults(array(
		'controller' => 'ads',
		'action'     => 'new',
	));
	
// Route Edit
Route::set('ads_edit', 'ads/edit(/<id>)')
	->defaults(array(
		'controller' => 'ads',
		'action'     => 'edit',
	));
	
// Route Delete
Route::set('ads_delete', 'ads/delete(/<id>)')
	->defaults(array(
		'controller' => 'ads',
		'action'     => 'delete',
	));
	
// Route default
Route::set('ads', 'ads(/<action>(/<page>))')
	->defaults(array(
		'controller' => 'ads',
		'action'     => 'index',
	));