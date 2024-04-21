<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    // Получить список всех фотографий
    public function index()
    {
        $photos = Photo::all();
        return response()->json($photos);
    }

    // Получить конкретную фотографию по ID
    public function show($id)
    {
        $photo = Photo::find($id);
        if (!$photo) {
            return response()->json(['message' => 'Фотография не найдена'], 404);
        }
        return response()->json($photo);
    }

    // Загрузить новую фотографию
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image_path' => 'required|image',
            'user_id' => 'required|exists:users,id'
        ]);

        $photo = new Photo();
        $photo->title = $request->title;
        $photo->image_path = $request->file('image_path')->store('photos');
        $photo->user_id = $request->user_id;
        $photo->save();

        return response()->json($photo, 201);
    }

    // Обновить информацию о фотографии (например, изменить название)
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $photo = Photo::find($id);
        if (!$photo) {
            return response()->json(['message' => 'Фотография не найдена'], 404);
        }

        $photo->title = $request->title;
        $photo->save();

        return response()->json($photo);
    }

    // Удалить фотографию
    public function destroy($id)
    {
        $photo = Photo::find($id);
        if (!$photo) {
            return response()->json(['message' => 'Фотография не найдена'], 404);
        }

        $photo->delete();
        return response()->json(['message' => 'Фотография удалена']);
    }

    // Получить список фотографий, которыми пользователь поделился с другими
    public function sharedPhotos()
    {
    }
}
