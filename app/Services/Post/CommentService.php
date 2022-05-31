<?php


namespace App\Services\Post;


use App\Dto\Post\CommentDto;
use App\Models\Comment;
use App\Models\Post;

class CommentService
{
    public function addNewComment(CommentDto $dto,$parentId=0)
    {
        return Comment::create(['parentId'=>$parentId,'content' => $dto->getContent(), 'postId' => $dto->getPostId(), 'authorId' => request()->user()->id]);
    }

    public function updateComment(CommentDto $dto, Comment $comment)
    {
        $comment->content = $dto->getContent();
        $comment->save();
        return $comment;
    }

    public function getAllComments(int $postId)
    {
        return Post::query()->find($postId)->comments()->where('parentId',0)->get();
    }

    public function deleteCommentAndRelatedComment(Comment $comment){
        Comment::query()->where('parentId',$comment->id)->delete();
        $comment->delete();
    }
}
