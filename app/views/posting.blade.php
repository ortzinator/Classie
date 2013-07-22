@extends('layout')

@section('content')

<?php 
$poster = $fied->user()->first();
$user_is_poster = Sentry::check() && $poster->id == Sentry::getUser()->id; ?>
<div class="page-header">
	<h2>{{{ $fied->title }}}</h2>
</div>
<div class="row">
	<div class="span8">
		<div id="classified">
			{{ Markdown::string($fied->content) }}
		</div>
		<hr>
		<h4>Questions:</h4>
		@if(!$fied->questions)
		<div class="alert alert-info">No questions asked yet.</div>
		@else
			@foreach($fied->questions as $q)
				<div class="comment">
					<h4 class="author">{{ $q->user->username }}</h4>
					<div class="comment-content">{{ nl2br(htmlspecialchars($q->content)) }}</div>
					@if(count($q->children) < 1 && $user_is_poster)
						<p>Post answer</p>
					@else
						@foreach($q->children as $a)
							<div class="comment reply">
								<h4 class="author">{{ $a->user->username }}</h4>
								<div class="comment-content">{{ $a->content }}</div>
							</div>
						@endforeach
					@endif
				</div>
			@endforeach
		@endif

		{{ Form::open(array('route' => 'newPost')) }}
			@if($user_is_poster)
				{{ Form::label('question', 'Add an addendum:') }}
			@else
				<label for="question">
					{{ Auth::check() ? 'Ask the seller a question about this classified:' : 
					'Please ' . link_to('auth/login', 'log in') . ' to ask questions' }}
				</label>
			@endif
			<div>{{ Form::textarea('question', '', array('style' => 'height: 50px;', 
				'class' => 'autoexpand input-xlarge' . (Auth::check() ? '' : ' disabled'))) }}</div>
			{{ Form::submit('Submit', 
				array('class' => 'btn btn-small' . (Auth::check() ? '' : ' disabled'))) }}
		{{ Form::close() }}
	</div>
	<div class="span4">
		<h4>Seller info:</h4>

		<p>{{ link_to_route('userProfile', $poster->username, array($poster->id)) }}</p>
		<p>Area: {{{ $fied->area }}}</p>
		<p>Date posted: {{ $fied->created_at->format('m/d/y g:i A') }}</p>
	</div>
</div>

@stop