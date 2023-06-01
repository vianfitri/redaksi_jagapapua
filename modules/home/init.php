<?php

// Route default
Route::set('home', 'home(/<action>(/<page>))')
	->defaults(array(
		'controller' => 'Home',
		'action'     => 'index',
	));