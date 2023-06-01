<?php

// Route Ajax Save
Route::set('ajax_headline_save', 'ajax/headline/save')
	->defaults(array(
		'controller' => 'Ajax_Headline',
		'action'     => 'save',
	));

// Route search popup
Route::set('headline_popup_search', 'headline/popup/search(/<search>(/<page>))')
	->defaults(array(
		'controller' => 'Headline',
		'action'     => 'popupsearch',
	));

// Route delete
Route::set('headline_delete', 'headline/delete(/<id>)')
	->defaults(array(
		'controller' => 'Headline',
		'action'     => 'delete',
	));

// Route popup
Route::set('headline_sync', 'headline/sync(/<cat>)')
	->defaults(array(
		'controller' => 'Headline',
		'action'     => 'sync',
	));

// Route popup
Route::set('headline_popup', 'headline/popup(/<page>)')
	->defaults(array(
		'controller' => 'Headline',
		'action'     => 'popup',
	));


// Route popup
Route::set('headline_popup', 'headline/index(/<cat>(/<name>))')
	->defaults(array(
		'controller' => 'Headline',
		'action'     => 'index',
	));