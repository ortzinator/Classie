@extends('layouts.app')

@section('content')
    <div class="container" x-data="{ currentImage: '{{ asset('storage/images/' . $post['images'][0]['file']) }}'}">
        <h1>{{ $post->title }}</h1>
        <a :href="currentImage" target="_blank"><img :src="currentImage" alt="" height="400"></a>
        <div class="row">
            @foreach($post['images'] as $image)
                <div class="col col-sm-1">
                    <a href="#" @click.prevent="currentImage = '{{ asset('storage/images/' . $image['file']) }}'">
                        <img src="{{ asset('storage/images/th_' . $image['file']) }}" class="img-thumbnail">
                    </a>
                </div>
            @endforeach
        </div>
        <div>{!! nl2br(e($post->body)) !!}</div>
    </div>
@endsection