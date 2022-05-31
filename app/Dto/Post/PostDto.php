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


    public function __construct(PostRequest $request)
    {
        $this->title = $request->title;
        $this->link = $request->link;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getLink(){
        return $this->link;
    }


}
