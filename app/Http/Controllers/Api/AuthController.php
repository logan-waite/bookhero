<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Create a new user entry.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
      // The register function will simply check the database for
      // matching emails and add the credentials.
      // After, we'll attempt to login in with the new credentials.

      // verify credentials
      $name = $request->get('name',null);
      $email = $request->get('email',null);
      $password = $request->get('password',null);

      $user = User::where('email', $email)->first();
      // check if email already exists
      if ( $user !== null) {
        return Response::create([ 'message' => 'Email already in use.' ], 409);
      }

      // create user
      $user = new User();
      $user->fill([
        'name' => $name,
        'email' => $email,
        'password' => Hash::make($password)
      ]);

      try {
          $user->saveOrFail();

      } catch (\Throwable $exception) {
          return Response::create([ 'message' => $exception->getMessage() ], 500);
      }

      return $user;
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