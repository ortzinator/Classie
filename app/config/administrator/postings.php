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
			'category' => array(
				'title' => 'Category',
				'relationship' => 'category',
				'select' => '(:table).name'
				),
			'content' => array('title' => 'Content'),
			),
		'edit_fields' 	=> array(
			'id',
			'title',
			'area',
			'category' => array(
					'type' => 'relationship',
					'name_field' => 'name'
				),
			'content' => array('type' => 'textarea'),
			),
	);