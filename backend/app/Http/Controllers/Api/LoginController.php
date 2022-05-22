<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Facades\Response;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRegistionRequest;

class LoginController extends Controller
{
    /**
     * Register a new seller on the application
     *
     * @param \App\Http\Requests\CustomerRegistionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(CustomerRegistionRequest $request)
    {
        $customer = Customer::create(array_merge(
            $request->only('firstName', 'lastName', 'email', 'phone'),
            ['password' => bcrypt($request->password)]
        ));
        return new ApiResource($customer);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $this->validate(request(), [
            'email'    => ['required', 'email'],
            'password' => 'required'
        ]);

        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return Response::unauthorized("Email or password doesn't match");
        }

        return $this->respondWithToken($token);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}