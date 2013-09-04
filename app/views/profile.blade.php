@extends('layout')

@section('content')

<div class="page-header">
	<h1>{{ $user->username }}</h1>
</div>

<h2>Classifieds</h2>

@if(isset($posts) && count($posts) > 0)
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
@else
<div class="alert alert-info">This user has no active classifieds.</div>
@endif

@stop