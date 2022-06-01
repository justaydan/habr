<?php

namespace App\Http\Requests;

use App\Dto\User\UserDto;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\Pure;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
            'username' => ['unique:users', 'required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/']
        ];
    }

    /**
     * Get UserDto from request.
     */
    #[Pure] public function toDto(): UserDto
    {
        return new UserDto($this);
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
}
