@extends('layout')

@section('content')
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
    
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
        </div>

        <div class="form-group">
            <label for="body">Body</label>
            <textarea type="text" name="body" id="body" class="form-control">
                {{ old('body') }}
            </textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection