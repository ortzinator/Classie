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

@include('partials.postinglist', ['postings' => $recent])

{{ $recent->links() }}

@stop