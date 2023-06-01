<?php

// Route Ajax Save
Route::set('ajax_choice_save', 'ajax/choice/save')
	->defaults(array(
		'controller' => 'Ajax_Choice',
		'action'     => 'save',
	));
	
// Route Ajax Save
Route::set('ajax_choice_change', 'ajax/choice/change(/<id>(/<id_src>))')
	->defaults(array(
		'controller' => 'Ajax_Choice',
		'action'     => 'change',
	));

// Route Ajax Save // Added By Irul FZ
Route::set('ajax_choiceramadan_save', 'ajax/choiceramadan/save')
	->defaults(array(
		'controller' => 'Ajax_Choiceramadan',
		'action'     => 'save',
	));


// Route search popup
Route::set('choice_popupchange_search', 'choice/popupchange/search(/<id>(/<search>))')
	->defaults(array(
		'controller' => 'Choice',
		'action'     => 'popupchangesearch',
	));
	
// Route search popup
Route::set('choice_popup_search', 'choice/popup/search(/<search>(/<page>))')
	->defaults(array(
		'controller' => 'Choice',
		'action'     => 'popupsearch',
	));
	
// Route delete
Route::set('choice_delete', 'choice/delete(/<id>)')
	->defaults(array(
		'controller' => 'Choice',
		'action'     => 'delete',
	));

// Route popup
Route::set('choice_popup', 'choice/popup(/<page>)')
	->defaults(array(
		'controller' => 'Choice',
		'action'     => 'popup',
	));

// Route popup change
Route::set('choice_popup_change', 'choice/popupchange(/<id>(/<page>))')
	->defaults(array(
		'controller' => 'Choice',
		'action'     => 'popupchange',
	));





// PICKUP
Route::set('choice_popuppickupchange_search', 'choice/popuppickupchange/search(/<id>(/<search>))')
	->defaults(array(
		'controller' => 'Choice',
		'action'     => 'popuppickupchangesearch',
	)); 
	
Route::set('choice_popuppickup_search', 'choice/popuppickup/search(/<search>(/<page>))')
	->defaults(array(
		'controller' => 'Choice',
		'action'     => 'popuppickupsearch',
	));

Route::set('choice_popuppickup', 'choice/popuppickup(/<page>)')
	->defaults(array(
		'controller' => 'Choice',
		'action'     => 'popuppickup',
	));

Route::set('choice_popuppickup_change', 'choice/popuppickupchange(/<id>(/<page>))')
	->defaults(array(
		'controller' => 'Choice',
		'action'     => 'popuppickupchange',
	));


// Route popup
Route::set('tagspin_popup', 'tagspin/index(/<cat>)')
	->defaults(array(
		'controller' => 'Tagspin',
		'action'     => 'index',
	));

	// Route Ajax Save
	Route::set('ajax_tagspin_save', 'ajax/tagspin/save')
		->defaults(array(
			'controller' => 'Ajax_Tagspin',
			'action'     => 'save',
		));

	// Route delete
	Route::set('tagspin_delete', 'tagspin/delete(/<cat>(/<id>))')
		->defaults(array(
			'controller' => 'Tagspin',
			'action'     => 'delete',
		));

	// Route popup
	Route::set('tagspin_sync', 'tagspin/sync(/<id>)')
		->defaults(array(
			'controller' => 'Tagspin',
			'action'     => 'sync',
		));
