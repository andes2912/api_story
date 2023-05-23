<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    protected $auth;

    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }
    //Login Controller
    public function index(Request $request)
    {
        return $this->auth->Login($request);
    }

    // profile
    public function profile()
    {
      return $this->auth->Profile();
    }

    // Logout
    public function logout(Request $request)
    {
      return $this->auth->Logout($request);
    }
}
