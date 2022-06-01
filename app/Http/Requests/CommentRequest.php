<?php

namespace App\Http\Requests;

use App\Dto\Post\CommentDto;
use App\Dto\Post\PostDto;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use JetBrains\PhpStorm\Pure;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return \string[][]
     */
    public function rules()
    {
        return [
            'content' => ['required', 'min:1', 'string'],
            'postId' => ['exists:posts,id']
        ];
    }

    /**
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->route('postId'))
            $this->merge(['postId' => $this->route('postId')]);
    }

    /**
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => $validator->errors()->all(),
            'data' => null,
        ], 422));
    }


    /**
     * Get CommentDto from request.
     */
    #[Pure] public function toDto(): CommentDto
    {
        return new CommentDto($this);
    }

}
