<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRequest $request)
    {
        try {
            $dto = $request->toDto();
            $user = User::create(['username' => $dto->getUsername(), 'password' => $dto->getPassword()]);
            $success['token'] = $user->createToken('MyAuthApp')->plainTextToken;
            return response()->json($success, 200);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 422);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('username', $request->username)->first();
        if ($user) {
            if (password_verify($request->password, $user->password)) {
                $userToken = $user->createToken('MyAuthApp')->plainTextToken;
                $response = [
                    'token' => $userToken,
                    'user_id' => $user->id
                ];
                return response()->json($response);
            } else {
                $response = ['password' => __('Password mismatch')];
                return response()->json($response, 422);
            }
        } else {
            $response = ['username' => __('No user found with username')];
            return response()->json($response, 422);
        }
    }
}
