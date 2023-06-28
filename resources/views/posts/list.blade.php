@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Most Recent Posts</h1>

        @if($posts->isEmpty())
            <h3>Oops, there are no posts.</h3>
        @else
            <ul class="list-group">
                @foreach($posts as $post)
                    <li class="list-group-item">{{ $post->title }}</li>
                @endforeach
            </ul>

            {{ $posts->links() }}
        @endif
    </div>
@endsection