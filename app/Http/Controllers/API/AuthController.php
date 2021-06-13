<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    //Login Controller
    public function index(Request $request)
    {
      $credentials = request(['email', 'password']);
      if (!$token = auth()->attempt($credentials)) {
          return  response()->json([
              'errors' => [
                  'msg' => ['Incorrect username or password.']
              ]
          ], 401);
      }

      $user = Auth::user();
      $tokenResult = $user->createToken('Personal Access Token');
      $token = $tokenResult->accessToken;

      return \response()->json([
        'success' => true,
        'token'   => $token,
        // 'user'    => $user
      ], 200);
    }

    // profile
    public function profile()
    {
      $user = Auth::user();
      return response()->json([
        'user'  => $user
      ]);
    }

    // Logout
    public function logout(Request $request)
    {
      if (Auth::user()) {
        $user = Auth::user()->token();
        $user->revoke();

        $ActivityLog = ActivityLog::create([
          'user_id' => Auth::id(),
          'method'  => 'LogOut',
          'Note'    => 'Logout successfully'
        ]);

        return response()->json([
          'success' => true,
          'message' => 'Logout successfully',
          'log'     => $ActivityLog
        ],200);
      }else {
        return response()->json([
          'success' => false,
          'message' => 'Unable to Logout'
        ],400);
      }
    }
}
