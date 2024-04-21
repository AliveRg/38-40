<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Получить список всех пользователей
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Получить конкретного пользователя по ID
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Пользователь не найден'], 404);
        }
        return response()->json($user);
    }

    // Создать нового пользователя
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json($user, 201);
    }

    // Обновить информацию о пользователе
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id // Учитываем текущего пользователя при проверке уникальности email
        ]);

        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Пользователь не найден'], 404);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json($user);
    }

    // Удалить пользователя
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Пользователь не найден'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'Пользователь удален']);
    }

    // Получить список фотографий конкретного пользователя
    public function userPhotos($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Пользователь не найден'], 404);
        }

        $photos = $user->photos; // Предполагается, что у пользователя есть отношение photos() в модели User

        return response()->json($photos);
    }
}
