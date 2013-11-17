@extends('layout')

@section('content')
<div class="posting{{ ($fied->closed) ? ' closed' : '' }}">
	<div class="page-header">
		<h2>{{{ $fied->title }}}</h2>
	</div>
	<div class="row">
		<div class="span8">
			@if($fied->closed)
				<div class="alert alert-block">
					<h4>Closed</h4>
					The poster is no longer responding to queries regarding this posting, which will
					 be deleted shortly.
				</div>
			@endif
			<div id="classified">
				{{ $fied->content }}
			</div>
			<div class="thing">{{ $fied->foobar }}</div>
			<hr>

			<h4>Questions:</h4>
			
			@if(count($fied->questions) < 1)
			<p class="text-info">No questions asked yet.</p>
			@else
				@foreach($fied->questions as $question)
					<?php if(!$question->isTopLevel()) { continue; } ?>
					<div class="comment">
						<div class="comment-content">
							<h4 class="author">{{ $question->user->username }}</h4>
							<p>{{ $question->content }}</p>

							@if(!$question->children && $user_is_poster)
								<p>Post answer</p>
							@else
								@foreach($question->children as $answer)
									<div class="comment">
										<div class="comment-content">
											<h4 class="author">{{ $answer->user->username }}
												@if($poster->id == $answer->user->id)
													(poster)
												@endif
											</h4>
											{{ $answer->content }}
										</div>
									</div>
								@endforeach
							@endif
						</div>
					</div>
				@endforeach
			@endif
			@if(!$user_is_poster && !$fied->closed)
			{{ Form::open(['route' => 'doQuestion', 'class' => 'question-form']) }}
				{{ ($errors->any() && !$errors->has('content')) ? 
					'<div class="alert alert-error">An error occurred</div>' : '' }}
				<div class="control-group{{ ($errors->has('content')) ? ' error' : '' }}">
					<label for="content">
						{{ Sentry::check() ? 'Ask the seller a question about this classified:' : 
						'Please ' . link_to('auth/login', 'log in') . ' to ask questions' }}
					</label>
					{{ $errors->first('content', '<span class="help-inline">:message</span>') }}
					{{ Form::textarea('content', '', ['style' => 'height: 50px;', 
						'class' => 'autoexpand input-xlarge' . (Sentry::check() ? '' : ' disabled')]) }}
					{{ Form::hidden('posting', $fied->id) }}
				</div>
				{{ Form::submit('Submit', 
					['class' => 'btn btn-small' . (Sentry::check() ? '' : ' disabled')]) }}
			{{ Form::close() }}
			@endif
		</div>
		<div class="span4">
			<h4>Seller info:</h4>

			<p>{{ HTML::linkRoute('users.show', $poster->username, [$poster->id]) }}</p>
			<p>Area: {{{ $fied->area }}}</p>
			<p>Date posted: {{ $fied->created_at }}</p>
			<p>Expires: {{ $fied->expires_at }}</p>
		</div>
	</div>
</div>

@stop