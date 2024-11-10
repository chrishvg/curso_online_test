<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Video;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categories = Category::all();
        if ($user->hasRole('Admin')) {
            $users = User::all();
            $courses = Course::with('category')->get();
            $videos = Video::with('course')->get();

            return view('dashboard', compact('users', 'courses', 'videos', 'categories'));
        }

        $courses = $user->courses;
        $allCourses = Course::with('category')
                        ->whereDoesntHave('users', function ($query) use ($user) {
                            $query->where('user_id', $user->id);
                        })->get();

        return view('user.dashboard', compact('allCourses', 'courses', 'categories'));
    }
}
