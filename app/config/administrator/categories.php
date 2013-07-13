<?php

return array(
		'title'			=>	'Categories',
		'single'		=>	'category',
		'model'			=>	'Category',
		'columns' 		=> 	array(
			'id' => array('title' => 'Id'),
			'name' => array('title' => 'Name'),
			'short_name' => array('title' => 'Short Name'),
			),
		'edit_fields' 	=> array(
			'id',
			'name',
			'short_name',
			),
	);