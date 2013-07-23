<?php

return array(
		'title'			=> 'Pages',
		'single'		=> 'page',
		'model'			=> 'Page',
		'form_width'	=> '800',
		'columns' 		=> array(
			'id' => array('title' => 'Id'),
			'title' => array('title' => 'Title'),
			'name',
			'content' => array('title' => 'Content'),
			),
		'edit_fields' 	=> array(
			'title',
			'name',
			'content' => array('type' => 'markdown', 'height' => '200'),
			),
	);