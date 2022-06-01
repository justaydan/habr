<?php

namespace App\Dto\Post;

use App\Http\Requests\PostRequest;

class PostDto
{

    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $link;

    /**
     * @param PostRequest $request
     */
    public function __construct(PostRequest $request)
    {
        $this->title = $request->title;
        $this->link = $request->link;
    }

    /**
     * @return mixed|string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed|string
     */
    public function getLink()
    {
        return $this->link;
    }


}
