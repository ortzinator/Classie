@if($postings->count())
	<?php
	$table = new Ortzinator\Classie\TableGenerator;
	$table->tableOpen = '<table class="table result table-striped">';
	$table->headings = array('Title', 'Area', 'Category');
	foreach ($postings as $row)
	{
		$title = HTML::linkRoute('posting.show', $row->title, [$row->id]);
		if ($row->closed) {
			$title = '<span class="label">Closed</span> ' . $title;
		}

		$table->addRow([$title, $row->area, $row->category->name]);
	}
	print $table->generate();
	?>
@else
	<p class="alert alert-warning">Sorry, no records were found that match that query.</p>
@endif