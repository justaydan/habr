<?php


namespace App\Dto\Post;


use App\Http\Requests\CommentRequest;

class CommentDto
{

    private string $content;
    /**
     * @var int|mixed|null
     */
    private ?int $postId;

    /**
     * CommentDto constructor.
     * @param CommentRequest $commentRequest
     */
    public function __construct(CommentRequest $commentRequest)
    {
        $this->content = $commentRequest['content'];
        $this->postId = $commentRequest->postId;

    }

    public function getContent()
    {
        return $this->content;
    }

    public function getPostId()
    {
        return $this->postId;
    }
}
