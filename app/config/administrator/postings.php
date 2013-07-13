<?php

return array(
		'title'			=>	'Postings',
		'single'		=>	'posting',
		'model'			=>	'Posting',
		'columns' 		=> 	array(
			'id' => array('title' => 'Id'),
			'user' => array(
				'title' => 'User',
				'relationship' => 'user',
				'select' => '(:table).username'
				),
			'title' => array('title' => 'Title'),
			'area' => array('title' => 'Area'),
			//'category' => array('title' => 'Category'),
			),
		'edit_fields' 	=> array(
			'id',
			//'user',
			'title',
			'area',
			//'category',
			),
	);