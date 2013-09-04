@extends('layout')

@section('content')

<h2>{{{ $category->name }}}</h2>

@if(count($category->postings) > 0)
<?php
$table = new Ortzinator\Classie\TableGenerator;
$table->tableOpen = '<table class="table result table-striped">';
$table->headings = array('Title', 'Area');
foreach ($category->postings as $post)
{
	$table->addRow([link_to_route('posting', $post->title, [$post->id]),
		$post->area]);
}
print $table->generate();
?>
@else
<div class="alert alert-info">This category has no active classifieds.</div>
@endif

@stop