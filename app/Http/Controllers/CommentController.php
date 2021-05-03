<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|',
            'recipe' => 'required|exists:recipes,id',
        ]);

        $comment = new Comment();
        $comment->body = $request->input('comment');
        $comment->recipe_id = $request->input('recipe');
        $comment->user_id = Auth::id();
        $comment->save();

        return back()->with('success', 'Comment posted!');
    }
}
