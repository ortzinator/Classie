@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/posts" method="POST" role="form">
            {{ csrf_field() }}

            <legend>Create Post</legend>

            @if($errors->count() > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3">
                <label class="form-label" for="title">Title:</label>
                <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                <label class="form-label" for="body">Body:</label>
                <textarea name="body" id="body" class="form-control" rows="3">{{ old('body') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection