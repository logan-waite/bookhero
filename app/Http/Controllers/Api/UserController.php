<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
  /**
   * Get the authenticated User.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getUser()
  {
    $user_id = auth()->user()->id;
    $user = User::with('attributes')->first();

    return response()->json($user);
  }

  public function getBookList() {
    return true;
  }
}
