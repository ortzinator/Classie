@if($postings->count())
	<?php
	$table = new Ortzinator\Classie\TableGenerator;
	$table->tableOpen = '<table class="table result table-striped">';
	$table->headings = array('Title', 'Area', 'Category');
	foreach ($postings as $row)
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