<?php

namespace App\Dto\User;

use App\Http\Requests\UserRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use JetBrains\PhpStorm\Pure;

/**
 * UserDto class.
 */
class UserDto
{
   

    /**
     * @var string
     */
    private string $username;

    /**
     * @var string
     */
    private string $password;

    /**
     * @param UserRequest $request UserRequest.
     */
    #[Pure] public function __construct(UserRequest $request)
    {
        $this->username = $request->username;
        $this->password = Hash::make($request->password);
    }


    /** @return string */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }


}
