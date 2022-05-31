<?php


namespace App\Services\Post;


use App\Dto\Post\CommentDto;
use App\Models\Comment;

class CommentService
{
    public function addNewComment(CommentDto $dto)
    {
        return Comment::create(['content' => $dto->getContent(), 'postId' => $dto->getPostId(), 'authorId' => request()->user()->id]);
    }

    public function updateComment(CommentDto $dto, Comment $comment)
    {
        $comment->content = $dto->getContent();
        $comment->save();
        return $comment;
    }
}
