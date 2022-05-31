<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


    public function update(CommentRequest $commentRequest, )
    {
        return $commentRequest;
        $comment = $this->commentService->updateComment($commentRequest->toDto(), $comment);
        return $comment;
    }


    /**
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->noContent();

    }
}
