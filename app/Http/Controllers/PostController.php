<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Auth\Access\AuthorizationException;

class PostController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        $post = $request->user()->posts()->create($validated);

        return redirect()
            ->route('posts.show', [$post])
            ->with('success', 'Post is submitted! Title: ' . $post->title . ' Description: ' . $post->description);

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @throws AuthorizationException
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $validated = $request->validated();

        $post->update($validated);

        return redirect()
            ->route('posts.show', [$post])
            ->with('success', 'Post is updated!');
    }

    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function destroy(Post $post): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()
            ->route('home')
            ->with('success', 'Post has been deleted!');
    }


    public function show_comments(Post $post): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {

        return view('posts.comments', [
            'post' => $post,
        ]);
    }
}
