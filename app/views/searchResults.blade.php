@extends('layout')

@section('content')

<div class="page-header">
	<h2>Search Results</h2>
</div>

@if(count($results) > 0)
	<?php
	$table = new TableGenerator;
	$table->tableOpen = '<table class="table result table-striped">';
	$table->headings = array('Title', 'Area', 'Category');
	foreach ($results as $row)
	{
		$table->addRow([link_to_route('posting', $row->title, [$row->id]),
			$row->area,
			$row->category->name]);
	}
	print $table->generate();
	?>
@else
	<p class="alert alert-warning">Sorry, no records were found that match that query.</p>
@endif

@stop