<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    const postStatuses = [
        Post::STATUS_DRAFT,
        Post::STATUS_PUBLISHED,
        Post::STATUS_REJECTED,
        Post::STATUS_PENDING,
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 30; $i++) {
            $post = new Post();
            $post->title = Str::random(12);
            $post->text = Str::random(120);
            $post->status = Post::STATUS_PENDING;
            $post->created_by = User::inRandomOrder()->first()->id;
            $post->save();

            $post->tags()->attach(random_int(1, 5));
            $post->save();
        }

        $posts = Post::all();
//        foreach ($posts as $post) {
//            $post->created_by = random_int(1, 5);
//            $post->save();
//        }
    }
}
