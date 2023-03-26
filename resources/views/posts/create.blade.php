@extends('layout')

@section('title', 'Create new post')

@section('content')
 <div class="p-8">
     <h1>Create a New Blog Post</h1>

     <form method="POST" action="{{ route('posts.store') }}">
         @csrf

         <label>Title</label>
         <input class="@error('title') error-border @enderror" type="text" name="title" value="{{ old('title') }}">
         @error('title')
         <div class="error">
             {{ $message }}
         </div>
         @enderror

         <label>Description</label>
         <textarea class="@error('description') error-border @enderror" name="description">{{ old('description') }}</textarea>
         @error('description')
         <div class="error">
             {{ $message }}
         </div>
         @enderror

         <button class="bg-amber-500" type="submit">Submit</button>
     </form>
 </div>
@endsection
