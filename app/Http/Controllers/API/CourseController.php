<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;

class CourseController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|integer|exists:categories,id', // Asegúrate de que la categoría exista
            'age_group' => 'required|string|max:6',
            'description' => 'nullable|string|max:255', // Haciendo la descripción opcional
        ]);

        $course = Course::create($validatedData);

        return redirect()->route('course.index');
    }
}
