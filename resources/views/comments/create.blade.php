@extends('layout')

@section('title', 'Create new Comment')

@section('content')
    <h1>Create a New Comment</h1>

    <form method="POST" action="{{ route('comments.store') }}">
        @csrf
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <label>Comment Content: </label>
        <textarea class="@error('content') error-border @enderror" name="content">{{ old('content') }}</textarea>
        @error('content')
        <div class="error">
            {{ $message }}
        </div>
        @enderror

        <button type="submit" class="bg-violet-500 hover:bg-amber-500 active:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-300">Submit</button>
    </form>
@endsection
