<?php

// Route ajax
Route::set('tags_ajax', 'tags/ajax(/<search>)')
	->defaults(array(
		'controller' => 'Tags',
		'action'     => 'ajax',
	));

// Route ajaxid
Route::set('tags_ajaxid', 'tags/ajaxid(/<search>)')
	->defaults(array(
		'controller' => 'Tags',
		'action'     => 'ajaxid',
	));

// Route edit
Route::set('tags_delete', 'tags/delete(/<id>)')
	->defaults(array(
		'controller' => 'Tags',
		'action'     => 'delete',
	));

// Route edit
Route::set('tags_edit', 'tags/edit(/<id>)')
	->defaults(array(
		'controller' => 'Tags',
		'action'     => 'edit',
	));

// Route index
Route::set('tags_index', 'tags/index(/<page>)')
	->defaults(array(
		'controller' => 'Tags',
		'action'     => 'index',
	));

// Route new
Route::set('tags_new', 'tags/new')
	->defaults(array(
		'controller' => 'Tags',
		'action'     => 'new',
	));	
	
// Route save
Route::set('tags_save', 'tags/save')
	->defaults(array(
		'controller' => 'Tags',
		'action'     => 'save',
	));	

// Route search
Route::set('tags_search', 'tags/search(/<search>(/<page>))')
	->defaults(array(
		'controller' => 'Tags',
		'action'     => 'search',
	));

// Route popup
Route::set('tags_popup', 'tags/popup(/<search>(/<page>(/<dom>)))')
	->defaults(array(
		'controller' => 'Tags',
		'action'     => 'popup',
	));
	
// Route update
Route::set('tags_update', 'tags/update')
	->defaults(array(
		'controller' => 'Tags',
		'action'     => 'update',
	));	
	
// Route default
Route::set('tags', 'tags(/<action>(/<page>))')
	->defaults(array(
		'controller' => 'Tags',
		'action'     => 'index',
	));