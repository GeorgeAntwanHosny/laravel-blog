<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
//    public function __construct()
//    {
//        $this->authorizeResource(Comment::class, 'comment');
//    }

    public function createCommentByPostID(Post $post): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {

        return view('comments.create',['post'=>$post]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validated();
        $validated['post_id'] = $request->input('post_id');

        $comment = $request->user()->comments()->create($validated);

        return redirect()
            ->route('comments.show', [$comment])
            ->with('success', 'your comment added successfully in the post');


    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
       return view('comments.show',['comment'=>$comment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('comments.edit',['comment'=>$comment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        $validated = $request->validated();

        $comment->update($validated);

        return redirect()
            ->route('comments.show', [$comment])
            ->with('success', 'comment is updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete',$comment);
        $comment->delete();

        return redirect()
            ->route('home')
            ->with('success', 'comment has been deleted!');
    }
}
