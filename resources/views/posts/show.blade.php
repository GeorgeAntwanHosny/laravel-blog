@extends('layout')

@section('title', $post->title)

@section('content')
<div class="post-item">
  <div class="post-content">
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->description }}</p>
      <div class="flex">
          <div class="flex-auto">
              @can('update', $post)
                  <a href="{{ route('posts.edit', [$post]) }}"><button class="bg-amber-500">Edit post</button></a>
              @endcan
          </div>

          <div class="flex-auto ">
              <a href="{{ route('show_post_comments', [$post]) }}"> <button class="success" type="submit"> show comments </button></a>

          </div>
          <div class="flex-auto">
              @can('delete', $post)
                  <form method="POST" action="{{ route('posts.destroy', [$post]) }}">
                      @csrf
                      @method('DELETE')
                      <button class="delete" type="submit">Delete post</button>
                  </form>
              @endcan
          </div>
          <div class="flex-auto hover:-backdrop-hue-rotate-180">
              <a href="{{ route('comments.create',[$post]) }}"> <button class="bg-violet-500 hover:bg-violet-600 active:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-300" type="submit"> add Comment </button></a><br>

          </div>

      </div>
            <small>Posted by <b>{{ $post->user->name }}</b></small>
    <div>

@endsection
