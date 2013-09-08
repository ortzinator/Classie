<?php

return array(
		'title'			=>	'Categories',
		'single'		=>	'category',
		'model'			=>	'Ortzinator\Classie\Models\Category',
		'columns' 		=> 	array(
			'id' => array('title' => 'Id'),
			'name' => array('title' => 'Name'),
			'short_name' => array('title' => 'Short Name'),
			),
		'edit_fields' 	=> array(
			'name',
			'parent' => array(
					'type' => 'relationship',
					'name_field' => 'name'
				),
			),
	);