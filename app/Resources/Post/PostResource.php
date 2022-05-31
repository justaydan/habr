<?php

namespace App\Resources\Post;

use Illuminate\Http\Resources\Json\JsonResource;


class PostResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'link' => $this->link,
            'created'=>date('Y-m-d',strtotime($this->created_at)),
            'author_name' => $this->author()->first()->username,
            'upvote'=>$this?->votes(),
            'comments'=>$this?->comments()->count()
        ];
    }
}
