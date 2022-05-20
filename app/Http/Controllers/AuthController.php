<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('login')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {

        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::ForLogin($fields['email'])->first();

        // Check user exists
        if(!$user) {
            return response([
                'message' => __('auth.failed')
            ], 401);
        }

        // Check password
        if(!Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => __('auth.password')
            ], 401);
        }

        $token = $user->createToken('login')->plainTextToken;
        $user->update(['last_activity_date' => now()]);

        $response = [
            'user' => $user,
            'token' => $token,
            'navigation' => $this->getItemMenu($user)
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {

        auth()->user()->tokens()->delete();

        return [
            'message' => __('auth.logout')
        ];
    }

    /**
     * @param User $user
     * @return array
     */
    public function getItemMenu(User $user) : array {

        $menu = [];
        Menu::role($user->roles->pluck('name'))->get()->each(function ($item) use (&$menu) {
            $menu[] = [
                'name' => $item->name,
                'icon' => $item->icon,
                'href' => $item->href
            ];
        });
        return $menu;
    }
}
