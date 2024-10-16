<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\Api\UserResources;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Регистрация
    public function register(RegisterRequest $request)
    {
        // Извлекаем роль для пользователя
        $role_id = Role::where('code','user')->first()->id;

        // Извлекаем валидированные данные
        $validated = $request->validated();

        // Создаем нового пользователя
        $user = User::create(array_merge($validated, ['role_id' => $role_id]));

        // Создаем токен для пользователя
        //$token = $user->createToken('remember_token')->plainTextToken;
        //$user->remember_token = $token;
        //$user->save();

        $token = $user->createToken('token')->plainTextToken;

        // Возвращаем ответ с токена
        return response()->json(/*new UserResources($user)*/
        [
            'user' => new UserResources($user),
            'token' => $token,
        ]
        )->setStatusCode(201);

    }

    public function login(Request $request){

        if (!Auth::attempt($request->only('login', 'password'))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = Auth::user()->createToken('token')->plainTextToken;
        return response()->json([$token]);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
