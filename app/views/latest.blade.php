@extends('layout')

@section('content')

@if(Sentry::check())
	<h1>{{{ Setting::get('classie.site_title') }}}</h1>
	<p>{{{ Setting::get('classie.site_description_short') }}}</p>
@else
<div id="welcome" class="hero-unit">
	<h1>{{{ Setting::get('classie.site_title') }}}</h1>
	<p>{{{ Setting::get('classie.site_description_long') }}}</p>
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
	$title = link_to_route('posting', $row->title, [$row->id]);
	if ($row->closed) {
		$title = '<span class="label">Closed</span> ' . $title;
	}
	$table->addRow([$title,	$row->area,	$row->category->name]);
}
print $table->generate();
?>

{{ $recent->links() }}

@stop