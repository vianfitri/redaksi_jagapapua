<?php

// Route delete
Route::set('news_child', 'news/child(/<parent_id>)')
	->defaults(array(
		'controller' => 'News',
		'action'     => 'child',
	));

// Route delete
Route::set('news_delete', 'news/delete(/<id>)')
	->defaults(array(
		'controller' => 'News',
		'action'     => 'delete',
	));
	
// Route detail
Route::set('news_detail', 'news/detail(/<id>)')
	->defaults(array(
		'controller' => 'News',
		'action'     => 'detail',
	));

// Route edit
Route::set('news_edit', 'news/edit(/<id>)')
	->defaults(array(
		'controller' => 'News',
		'action'     => 'edit',
	));
	
// Route approved
Route::set('news_approved', 'news/approve/submit')
	->defaults(array(
		'controller' => 'News',
		'action'     => 'approvesubmit',
	));
	
// Route approve detail
Route::set('news_approve', 'news/approve(/<id>)')
	->defaults(array(
		'controller' => 'News',
		'action'     => 'approve',
	));

// Route index
Route::set('news_index', 'news/index(/<page>)')
	->defaults(array(
		'controller' => 'News',
		'action'     => 'index',
	));
	
// Route list approve
Route::set('news_list_approve', 'news/listapprove(/<page>)')
	->defaults(array(
		'controller' => 'News',
		'action'     => 'listapprove',
	));
	
// Route new
Route::set('news_new', 'news/new')
	->defaults(array(
		'controller' => 'News',
		'action'     => 'new',
	));
	
// Route Save
Route::set('news_save', 'news/save')
	->defaults(array(
		'controller' => 'News',
		'action'     => 'save',
	));

// Route search
Route::set('news_search', 'news/search(/<page>)')
	->defaults(array(
		'controller' => 'News',
		'action'     => 'search',
	));
	
// Route Update
Route::set('news_update', 'news/update')
	->defaults(array(
		'controller' => 'News',
		'action'     => 'update',
	));
	
// Route Insert Video
Route::set('news_insertvideo', 'news/insertvideo')
	->defaults(array(
		'controller' => 'News',
		'action'     => 'insertvideo',
	));