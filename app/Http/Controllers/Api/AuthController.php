<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\Api\UserResources;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $user = User::create([... $validated, 'role_id' => $role_id]);

        $user->api_token = Hash::make(Str::random(60));
        $user->save();

        // Возвращаем ответ с токена
        return response()->json(/*new UserResources($user)*/
        [
            'user' => new UserResources($user),
            'token' => $user->api_token,
        ]
        )->setStatusCode(201);

    }

    public function login(Request $request){

        if (!Auth::attempt($request->only('login', 'password'))) {
            throw new ApiException("Не верный логин/пароль",401);
        }
        // Получение текущего пользователя
        $user = Auth::user();

        // Создание нового токена для пользователя
        $user->api_token = Hash::make(Str::random(60));
        $user->save();
        return response()->json(['token' => $user->api_token])->setStatusCode(200);
    }

    public function logout(Request $request){
        // Получение текущего пользователя
        $user = Auth::user();
        $user->api_token = null;
        $user->save();
        return response()->json(['message' => 'Вы вышли из системы'])->setStatusCode(200);
    }
}
