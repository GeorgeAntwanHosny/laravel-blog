@extends('layout')

@section('title', 'all comments for this Post '. $post->title)

@section('content')

    @forelse($post->comment as $comment)
        <div class="post-item">
            <div class="post-content">

                <h4>{{ $comment->content }}</h4>
                <h5>commented by <b>{{ $comment->user->name }}</b></h5>
                <small>created at <b>{{ $comment->created_at }}</b></small><br>
                <small>updated at <b>{{ $comment->updated_at }}</b></small><br>
                @can('view', $comment)
                <a href="{{ route('comments.show', [$comment]) }}"> <button class="success" type="submit"> more actions </button></a>
                @endcan

            </div>
        </div>

    @empty
        <h2>There are no comments yet.</h2>
    @endforelse
@endsection
