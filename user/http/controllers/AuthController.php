<?php namespace AppUser\User\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use AppUser\User\Models\User;
use AppUser\User\Classes\Services\AuthService;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:appuser_user_users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'username' => $request->input('username'),
            'password' => AuthService::hashPassword($request->input('password')),
            'token' => bin2hex(random_bytes(32)), // Generate secure token
        ]);

        return response()->json(['token' => $user->token], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->input('username'))->first();

        if ($user && password_verify($request->input('password'), $user->password)) {
            // Return the user's token
            return response()->json(['token' => $user->token]);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }

        public function logout(Request $request)
        {
            $token = $request->bearerToken();
    
            if ($token) {
                $user = User::where('token', $token)->first();
                if ($user) {
                    // Invalidate the token or remove it
                    $user->token = null;
                    $user->save();
    
                    return response()->json(['message' => 'Logged out successfully.'], 200);
                }
            }
    
            return response()->json(['error' => 'Unable to log out.'], 400);
        }
}
