<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\Video;

class CommentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('Admin')) {
            $comments = Comment::all();
            return view('comment.index', compact('comments'));
        }

        $comments = Comment::where('user_id', $user->id)
                            ->where('approved', true)->get();

        return view('comment.indexuser', compact('comments'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'comment' => 'required|string|max:255',
        ],[
            'comment.required' => 'El campo "Comentario" es obligatorio.',
        ]);

        $validatedData['video_id'] = $request->input('video_id');
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['approved'] = false;

        $comment = Comment::create($validatedData);
        return redirect()->route('comments');
    }

    public function writeComment($videoId)
    {
        $video = Video::findOrFail($videoId);
        $user = Auth::user();

        return view('comment.write', compact('video'));
    }

    public function approve($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->approved = true;
        $comment->save();

        return redirect()->route('comments');
    }

    public function decline($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->approved = false;
        $comment->save();

        return redirect()->route('comments');
    }
}
