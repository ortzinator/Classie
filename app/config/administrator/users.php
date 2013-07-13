<?php

return array(
		'title'			=>	'Users',
		'single'		=>	'user',
		'model'			=>	'User',
		'columns' 		=> 	array(
			'id' => array('title' => 'Id'),
			'username' => array('title' => 'Username'),
			'email' => array('title' => 'Email'),
			'first_name' => array('title' => 'First Name'),
			'last_name' => array('title' => 'Last Name'),
			'activated' => array('title' => 'Activated'),
			),
		'edit_fields' 	=> array(
			'id',
			'username',
			'email',
			'first_name',
			'last_name',
			'activated',
			),
	);