@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <svg class="m-4" width="320" height="320" xmlns="http://www.w3.org/2000/svg"
             role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice"
             focusable="false">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#868e96"></rect>
        </svg>
        <div>{!! nl2br(e($post->body)) !!}</div>
    </div>
@endsection