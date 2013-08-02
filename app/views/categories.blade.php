@extends('layout')

@section('content')

<ul>
@foreach($categories as $cat)
<li>{{ $cat->name }}
	@if(count($cat->children()) > 0)
		<ul>
		@foreach($cat->children()->get() as $sub_cat)
			<li>{{ $sub_cat->name }}</li>
		@endforeach
		</ul>
	@endif
</li>
@endforeach
</ul>

@stop