<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Branche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use function PHPSTORM_META\map;

class UserController extends Controller
{
    /**
     * get Auth token for Vue
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function user()
    {
        return response([
            'status' => 'success',
            'data' => auth('users')->user(),
        ]);
    }

    public function index(Request $request): Response
    {
        $users = User::paginate(20);

        return response([
            'data' => $users->items(),
            'count' => User::count()
        ]);
    }

    public function show(User $user)
    {
        return response([
            'data' => $user,
        ]);
    }

    public function store(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response([
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            return response([
                'errors' => [
                    'inspections' => ['Пользователь с почтой ' . $request->email . ' уже существует']
                ]
            ], 422);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return response([
            'data' => $user
        ]);
    }


    public function update(Request $request, User $user): Response
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response([
                'status' => 'error',
                'data' => $validator->errors()
            ], 422);
        }

        $userEmail = User::where('id', '!=', $user->id)->where('email', $request->email)->first();

        if ($userEmail) {
            return response([
                'status' => 'error',
                'data' => [
                    'email' => 'Указанная почта занята другим пользователем, укажите другую'
                ]
            ], 422);
        }
        $user->name = $request->name;
        $user->email = $request->email;

        if (isset($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response([
            'data' => $user
        ]);
    }

    /**
     * Login user
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
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

        $credentials = $request->only('email', 'password');

        if (Auth::guard('users')->attempt($credentials)) {
            $request->session()->regenerate();

            $user = auth('users')->user();

            $token = $request->user('users')->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Успешная авторизация',
                'token' => $token,
                'user' => $user
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
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {

        $user = $request->user('users');
        // Инвалидация сессии

        $user->tokens()->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Auth::guard('users')->logout();

        return response()->json([
            'success' => true,
            'message' => 'Успешный выход из системы'
        ], 200);
    }
}
