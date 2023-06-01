<?php
	
// Route default
Route::set('api', 'api/image(/<action>(/<page>))')
	->defaults(array(
		'controller' => 'api',
		'action'     => 'image',
	));