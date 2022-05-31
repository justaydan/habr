<?php


namespace App\Resources\Post;


use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{

    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        $nestedComments = [];

        if (!($comments = $this->comments()->get())->isEmpty()) {
            foreach ($comments as $comment) {
                $nestedComments[] = ['content' => $comment->content, 'id' => $comment->id, 'author_name' => $comment->author->username, 'created' => date('Y-m-d H:i:s', strtotime($comment->created_at))];
            }
        }

        return [
            'id' => $this->id,
            'content' => $this->content,
            'author_name' => $this->author()->first()->username,
            'comments' => $nestedComments
        ];
    }
}
