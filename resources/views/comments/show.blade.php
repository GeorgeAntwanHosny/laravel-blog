@extends('layout')

@section('title', $comment->post->title)

@section('content')

    <div class="post-item">
        <div class="post-content">

            <h3>comment content : {{ $comment->content }}</h3>
            <h4>commented by <b>{{ $comment->user->name }}</b></h4>
            <small>created at <b>{{ $comment->created_at }}</b></small><br>
            <small>updated at <b>{{ $comment->updated_at }}</b></small><br>
           <div class="flex p-2 space-x-2">
               @can('update', $comment)
                   <a href="{{ route('comments.edit', [$comment]) }}"><button class="success" type="submit">Edit post </button></a>
               @endcan

               @can('delete', $comment)
                   <form method="POST" action="{{ route('comments.destroy', [$comment])}}">
                       @csrf
                       @method('DELETE')
                       <button class="delete" type="submit">Delete Comment</button>
                   </form>
               @endcan
           </div>
        </div>
    </div>

@endsection
