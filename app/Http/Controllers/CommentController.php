<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function save(CommentRequest $request)
    {
        $validated = $request->validated();
        Comment::create($validated);

        return back()->with('success','Comment Added successfully!');
    }

    public function update(CommentRequest $request, Comment $comment)
    {
        $comment->update($request->validated());

        return back()->with('success','Comment updated successfully!');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()->with('success','Comment Deleted successfully!');
    }
}
