<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Resources\Post\CommentResource;
use Illuminate\Http\Request;
use App\Services\Post\CommentService;
use App\Http\Requests\CommentRequest;
use Symfony\Component\HttpFoundation\Response;


class CommentController extends Controller
{

    /**
     * CommentController constructor.
     * @param CommentService $commentService
     */
    public function __construct(private CommentService $commentService)
    {
    }


    /**
     * @param $postId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($postId)
    {
        return CommentResource::collection($this->commentService->getAllComments($postId));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request, $postId)
    {
        $dto = $request->toDto();
        $this->commentService->addNewComment($dto);
        return response()->noContent(201);
    }


    public function update(CommentRequest $commentRequest, Comment $comment)
    {
        $comment = $this->commentService->updateComment($commentRequest->toDto(), $comment);
        return $comment;
    }


    /**
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $this->commentService->deleteCommentAndRelatedComment($comment);
        return response()->noContent();

    }

    public function addCommentToComment(CommentRequest $commentRequest,$postId,$commentId)
    {
        $this->commentService->addNewComment($commentRequest->toDto(),$commentId);
        return response()->noContent(201);
    }
}
