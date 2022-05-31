<?php

namespace App\Services\Post;

use App\Dto\Post\PostDto;
use App\Models\Post;

class PostService
{
    public function createNewPost(PostDto $dto)
    {
        return Post::create([
            'title' => $dto->getTitle(),
            'link' => $dto->getLink(),
            'authorId' => request()->user()->id
        ]);
    }

    public function updatePost(PostDto $dto, Post $post)
    {
        $post->title = $dto->getTitle();
        $post->link = $dto->getLink();
        $post->save();
        return $post;
    }

    public function votePost($postId, $request)
    {
        if ($request->key == "up")
            request()->user()->votes()->sync([$postId]);
        else
            request()->user()->votes()->detach([$postId]);
    }

    public function getAllPosts(){
        return Post::query()->get();
    }
}
