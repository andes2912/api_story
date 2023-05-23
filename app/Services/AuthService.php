<?php
 namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Helpers\ClientResponderHelper;
use App\Models\ActivityLog;

class AuthService {
    use ClientResponderHelper;

    public function Login($params)
    {
       try {
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
            return $this->responseSuccess($token,'Success.');

       } catch (\Exception $e) {
            return $this->responseFailed($e->getMessage());
       }
    }

    public function Profile()
    {
        try {
            $user = Auth::user();
            return $this->responseSuccess($user,'Success.');
        } catch (\Exception $e) {
            return $this->responseFailed($e->getMessage());
        }
    }

    public function Logout($params)
    {
        try {
            if (Auth::user()) {
                $user = Auth::user()->token();
                $user->revoke();

                $ActivityLog = ActivityLog::create([
                    'user_id' => Auth::id(),
                    'method'  => 'LogOut',
                    'note'    => 'Logout successfully'
                ]);

               return $this->responseSuccess($ActivityLog,'Success.');
            }else {
                return $this->responseFailed(false, 'Unable to Logout');
            }
        } catch (\Exception $e) {
            return $this->responseFailed($e->getMessage());
        }
    }
}
