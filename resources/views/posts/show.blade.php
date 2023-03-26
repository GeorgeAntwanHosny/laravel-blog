@extends('layout')

@section('title', $post->title)

@section('content')
<div class="post-item">
  <div class="post-content">
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->description }}</p>
    @can('update', $post)
    <a href="{{ route('posts.edit', [$post]) }}">Edit post</a>
    @endcan
      <br>
     <a href="{{ route('show_post_comments', [$post]) }}"> <button class="success" type="submit"> show comments </button></a>
      <br>
    @can('delete', $post)
    <form method="POST" action="{{ route('posts.destroy', [$post]) }}">
      @csrf
      @method('DELETE')
      <button class="delete" type="submit">Delete post</button>
    </form>
    @endcan
      <a href="{{ route('comments.create',[$post]) }}"> <button class="bg-violet-500 hover:bg-violet-600 active:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-300" type="submit"> add Comment </button></a><br>

      <small>Posted by <b>{{ $post->user->name }}</b></small>
  </div>
</div>
@endsection
