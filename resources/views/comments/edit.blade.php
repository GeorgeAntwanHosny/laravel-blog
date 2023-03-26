@extends('layout')

@section('title', 'Update Post '. $comment->post->title)

@section('content')
    <h1>Update comment for this Post {{ $comment->post->title }}</h1>

    <form method="POST" action="{{ route('comments.update', [$comment]) }}">
        @csrf
        @method('PUT')
        <label>Comment Content: </label>
        <textarea class="@error('content') error-border @enderror" name="content">{{ old('content', $comment->content) }}</textarea>
        @error('content')
        <div class="error">
            {{ $message }}
        </div>
        @enderror

        <button type="submit">Update</button>
    </form>
@endsection
