@extends('layout')

@section('content')

@if(Sentry::check())
	<h1>{{{ Config::get('classie.site_title') }}}</h1>
	<h4>{{{ Config::get('classie.site_description_short') }}}</h4>
@else
<div id="welcome" class="hero-unit">
	<h1>{{{ Config::get('classie.site_title') }}}</h1>
	<p>{{{ Config::get('classie.site_description_long') }}}</p>
	<p>{{ link_to('pages/about', 'Learn more »', ['class'=>'btn primary large']) }}</p>
</div>
@endif
<h3>Recent Listings:</h3>

<?php
$table = new Ortzinator\Classie\TableGenerator;
$table->tableOpen = '<table class="table result table-striped">';
$table->headings = array('Title', 'Area', 'Category');
foreach ($recent as $row)
{
	$table->addRow([link_to_route('posting', $row->title, [$row->id]),
		$row->area,
		$row->category->name]);
}
print $table->generate();
?>

@stop