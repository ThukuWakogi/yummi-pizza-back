<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use App\User;
use App\Models\ShoppingCartItem;
use Tymon\JWTAuth\Exceptions\JWTException;

class APIController extends Controller
{
    public function login (Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
                'errors' => [
                    'email' => null,
                    'password' => null
                ]
            ], 401);
        }

        $user = JWTAuth::user($token);

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => JWTAuth::factory()->getTTL() * 60,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'pendingOrder' => $user->pendingOrder,
                'shoppingCart' => count($user->pendingOrder) > 0
                    ? ShoppingCartItem::where('order_id', $user->pendingOrder[0]->id)->get()
                    : []
            ]
        ]);
    }

    public function register(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = JWTAuth::fromUser($user);
        error_log(count($user->pendingOrder));

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => JWTAuth::factory()->getTTL() * 60,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'pendingOrder' => $user->pendingOrder,
                'shoppingCart' => count($user->pendingOrder) > 0
                    ? ShoppingCartItem::where('order_id', $user->pendingOrder[0]->id)->get()
                    : []
            ]
        ]);
    }

    public function getUserDetailsFromToken(Request $request) {
        $userFromToken = JWTAuth::toUser(explode(' ', $request->header('Authorization'))[1]);
        $user = User::find($userFromToken->id);
        //error_log($user->pendingOrder[0]->id);
        //$lool = ShoppingCartItem::where('order_id', $user->pendingOrder[0]->id);
        //error_log($lool);

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'pendingOrder' => $user->pendingOrder,
            'shoppingCart' => count($user->pendingOrder) > 0
                ? ShoppingCartItem::where('order_id', $user->pendingOrder[0]->id)->get()
                : []
        ], 200);
    }
}
