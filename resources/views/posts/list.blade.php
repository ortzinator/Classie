@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Most Recent Posts</h1>

        @if($posts->isEmpty())
            <h3>Oops, there are no posts.</h3>
        @else
            <div class="row row-cols-4 g-4">
                @foreach($posts as $post)
                    <div class="col">
                        <a href="{{ route('posts.show', $post->id) }}">
                            <div class="card h-100 bg-light">
                                <svg class="card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg"
                                     role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice"
                                     focusable="false">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#868e96"></rect>
                                </svg>
                                <div class="card-body">
                                    <h5 class="card-text">{{ $post->title }}</h5>
                                </div>
                                <div class="card-footer">
                                    Posted <span title="{{ $post->created_at }}">
                                        {{ $post->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection