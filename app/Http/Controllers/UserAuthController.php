<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserAuthController extends Controller
{
    /**
     * Login user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Валидация входных данных
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422);
        }

        // Попытка авторизации
        $credentials = $request->only('email', 'password');

        if (Auth::guard('users')->attempt($credentials)) {
            $user = Auth::user();

            return response()->json([
                'success' => true,
                'message' => 'Успешная авторизация'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Неверный email или пароль'
        ], 401);
    }

    /**
     * Logout user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('users')->logout();

        // Инвалидация сессии
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'message' => 'Успешный выход из системы'
        ], 200);
    }

    /**
     * get Auth token for Vue
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function getAuth(Request $request)  {
        return Auth::guard('users')->user();
    }
}
