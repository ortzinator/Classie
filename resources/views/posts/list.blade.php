@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Posts</h1>

        <ul class="list-group">
            @foreach($posts as $post)
                <li class="list-group-item">{{ $post->title }}</li>
            @endforeach
        </ul>
    </div>
@endsection