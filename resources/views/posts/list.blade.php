@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Most Recent Posts</h1>

        @if($posts->isEmpty())
            <h3>Oops, there are no posts.</h3>
        @else
            <div class="row row-cols-md-4 row-cols-1 g-4">
                @foreach($posts as $post)
                    <div class="col">
                        <a href="{{ route('posts.show', $post->id) }}">
                            <div class="card bg-light">
                                <div class="ratio ratio-4x3">
                                    <img src="https://placekitten.com/400/400"
                                         class="card-img-top object-fit-cover"
                                         alt="placekitten">
                                </div>
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