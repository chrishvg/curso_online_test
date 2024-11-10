<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
            $videos = Video::all();
            $courses = Course::all();
            return view('video.index', compact('videos', 'courses'));
        }

        return view('noallowed');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'course_id' => 'required|integer|exists:courses,id',
            'url' => 'required|url|max:255',
        ],[
            'title.required' => 'El campo "Título" es obligatorio.',
            'course_id.required' => 'El campo "Curso" es obligatorio.',
            'description.required' => 'El campo "Descripción" es obligatorio.',
            'url.url' => 'El campo "URL" debe ser una URL válida.',
        ]);

        $video = Video::create($validatedData);

        return redirect()->route('videos');
    }


    public function like($videoId)
    {
        $video = Video::findOrFail($videoId);
        $user = Auth::user();

        $existingLike = $video->likes()->where('user_id', $user->id)->first();

        if ($existingLike) {
            if ($existingLike->pivot->like == false) {
                $existingLike->pivot->update(['like' => true]);
            } else {
                $existingLike->pivot->update(['like' => false]);
            }
        } else {
            $video->likes()->attach($user->id, ['like' => true]);
        }

        return redirect()->route('home');
    }


}
