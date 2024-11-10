<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('category')->get();
        $categories = Category::all();
        return view('course.index', compact('courses', 'categories'));
    }

    public function show(Request $request)
    {
        return view('admin.courses.show');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:courses,name',
            'category_id' => 'required|integer|exists:categories,id',
            'age_group' => 'required|string|max:6',
            'description' => 'nullable|string|max:255',
        ],[
            'name.unique' => 'Este nombre de curso ya existe. Por favor, elige otro.'
        ]);

        $course = Course::create($validatedData);
        return redirect()->route('course');
    }

    public function register(Request $request)
    {
        $courseId = $request->input('course_id');
        $userId = $request->input('user_id');
        $course = Course::findOrFail($courseId);
        $user = User::findOrFail($userId);

        $course->users()->attach($user->id);
        return redirect()->route('home');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $categoryId = $request->input('category_id');
        $ageGroup = $request->input('age_group');

        $courses = Course::with('category', 'videos')
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('name', 'like', "%$query%")
                                     ->orWhere('description', 'like', "%$query%")
                                     ->orWhereHas('videos', function ($videoQuery) use ($query) {
                                         $videoQuery->where('title', 'like', "%$query%");
                                     });
            })
            ->when($categoryId && $categoryId !== 'All', function ($queryBuilder) use ($categoryId) {
                return $queryBuilder->where('category_id', $categoryId);
            })
            ->when($ageGroup && $ageGroup !== 'All', function ($queryBuilder) use ($ageGroup) {
                return $queryBuilder->where('age_group', $ageGroup);
            })
            ->get();

        return view('course.list', compact('courses'));
    }
}
