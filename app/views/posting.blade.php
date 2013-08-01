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
		@if(sizeof($questions) < 1)
		<div class="alert alert-info">No questions asked yet.</div>
		@else
			@foreach($questions as $q)
				<div class="comment">
					<div class="comment-content">
						<h4 class="author">{{ $q->user()->first()->username }}</h4>
						{{ Markdown::string($q->content) }}

						@if(count($q->children()) < 1 && $user_is_poster)
							<p>Post answer</p>
						@else
							@foreach($q->children()->get() as $a)
								<div class="comment">
									<div class="comment-content">
										<h4 class="author">{{ $a->user()->first()->username }}
											@if($poster->id == $a->user()->first()->id)
												(poster)
											@endif
										</h4>
										{{{ $a->content }}}
									</div>
								</div>
							@endforeach
						@endif
					</div>
				</div>
			@endforeach
		@endif
		{{ Form::open(array('route' => 'doQuestion', 'class' => 'question-form')) }}
			{{ ($errors->any() && !$errors->has('content')) ? 
				'<div class="alert alert-error">An error occurred</div>' : '' }}
			<div class="control-group{{ ($errors->has('content')) ? ' error' : '' }}">
			@if($user_is_poster)
				{{ Form::label('content', 'Add an addendum:') }}
			@else
				<label for="content">
					{{ Sentry::check() ? 'Ask the seller a question about this classified:' : 
					'Please ' . link_to('auth/login', 'log in') . ' to ask questions' }}
				</label>
			@endif
			{{ $errors->first('content', '<span class="help-inline">:message</span>') }}
			{{ Form::textarea('content', '', array('style' => 'height: 50px;', 
			'class' => 'autoexpand input-xlarge' . (Sentry::check() ? '' : ' disabled'))) }}
			{{ Form::hidden('posting', $fied->id) }}
			</div>
			{{ Form::submit('Submit', 
				array('class' => 'btn btn-small' . (Sentry::check() ? '' : ' disabled'))) }}
		{{ Form::close() }}
	</div>
	<div class="span4">
		<h4>Seller info:</h4>

		<p>{{ link_to_route('userProfile', $poster->username, array($poster->id)) }}</p>
		<p>Area: {{{ $fied->area }}}</p>
		<p>Date posted: {{ $fied->created_at->format('m/d/y g:i A') }}</p>
		<p>Expires: {{ $fied->expires_at->format('m/d/y g:i A') }}</p>
	</div>
</div>

@stop