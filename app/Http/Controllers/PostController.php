<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use App\Services\Post\PostService;
use Symfony\Component\HttpFoundation\Response;
use App\Resources\Post\PostResource;

class PostController extends Controller
{
    /**
     * PostController constructor.
     * @param PostService $postService
     */
    public function __construct(private PostService $postService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PostResource::collection($this->postService->getAllPosts());
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $dto = $request->toDto();
        $post = $this->postService->createNewPost($dto);
        return response()->json(new PostResource($post), 201);
    }


    /**
     * @param PostRequest $request
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PostRequest $request, Post $post)
    {
        $post = $this->postService->updatePost($request->toDto(), $post);
        return response()->json(new PostResource($post), 201);

    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post): Response
    {
        $post->delete();
        return response()->noContent();

    }

    public function vote($postId, Request $request)
    {
       $this->postService->votePost($postId,$request);
        return response()->noContent(200);
    }
}
