<?php

namespace App\Services\Post;

use App\Dto\Post\PostDto;
use App\Models\Post;

class PostService
{
    /**
     * @param PostDto $dto
     * @return mixed
     */
    public function createNewPost(PostDto $dto)
    {
        return Post::create([
            'title' => $dto->getTitle(),
            'link' => $dto->getLink(),
            'authorId' => request()->user()->id
        ]);
    }

    /**
     * @param PostDto $dto
     * @param Post $post
     * @return Post
     */
    public function updatePost(PostDto $dto, Post $post)
    {
        $post->title = $dto->getTitle();
        $post->link = $dto->getLink();
        $post->save();
        return $post;
    }

    /**
     * @param $postId
     * @param $request
     * @return void
     */
    public function votePost($postId, $request)
    {
        if ($request->key == "up")
            request()->user()->votes()->sync([$postId]);
        else
            request()->user()->votes()->detach([$postId]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllPosts()
    {
        return Post::query()->get();
    }
}
