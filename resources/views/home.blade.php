@extends('layout')

@section('title', 'Home')

@section('content')
    <div class="content-center p-8">
@forelse ($posts as $post)
<div class="post-item ">
  <div class="post-content">
    <h2><a  href="{{ route('posts.show', [$post]) }}"> <button class="bg-teal-500 hover:bg-amber-500">{{ $post->title }}</button></a></h2>
    <p>{{ $post->description }}</p>
    <small>Posted by <b>{{ $post->user?->name }}</b></small>
  </div>

</div>
@empty
<h2>There are no posts yet.</h2>
@endforelse
<div >
    {{$posts->links()}}

</div>
    </div>
@endsection
