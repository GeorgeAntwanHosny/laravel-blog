<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DatabaseTest extends TestCase
{   use WithoutMiddleware;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_the_post_model(): void
    {
       Post::factory()->count(3)->create();
       $this->assertDatabaseCount('posts',3);
    }
    public function test_the_posts_user_relationship()
    {
        $user = User::factory()
            ->hasPosts(5)
            ->create();
        $this->assertDatabaseCount('posts',5);
        $this->assertDatabaseCount('users',1);
        $this->assertDatabaseHas('posts',[
            'user_id' =>$user->id,
        ]);
    }
    public function test_the_posts_comment_relationship()
    {
        $post = Post::factory()->create();
        $user = User::factory()->create();
        $comment = Comment::factory()
            ->count(5)
            ->for($post)->for($user)
            ->create();
        $this->assertDatabaseCount('comments',5);
        $this->assertDatabaseCount('posts',1);
        $this->assertDatabaseCount('users',1);
        $this->assertDatabaseHas('comments',[
            'post_id' =>$post->id,
            'user_id' =>$user->id,
        ]);

    }
    public function test_the_authentication()
    {
        $user = User::factory()->create([
            'password' => Hash::make('abc123456789'),
        ]);
        $this->withoutMiddleware();
       $this->post('/login', [
            'email' => $user->email,
            'password' => 'abc123456789',
        ]);

        $this->assertAuthenticated();


    }
}
