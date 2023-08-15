<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Comment;
use App\Http\Resources\CommentResource;

use App\Jobs\CreateComment;

class CommentController extends Controller
{
    public function index($articleId)
    {
        $comments = Comment::where('article_id', $articleId)->get();
        return CommentResource::collection($comments);
    }

    public function create()
    {
        // Create form (Admin feature)
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'comment_text' => 'required|string',
        ]);

        $data['user_id'] = auth()->user()->id; // Assuming you're using authentication

        Comment::create($data);
        CreateComment::dispatch($data);

        return redirect()->route('articles.show', $data['article_id'])->with('success', 'Comment posted successfully.');
    }

    public function show(Comment $comment)
    {
        // Show a specific comment (Admin feature)
    }

    public function edit(Comment $comment)
    {
        // Edit form (Admin feature)
    }

    public function update(Request $request, Comment $comment)
    {
        // Update comment (Admin feature)
    }

    public function destroy(Comment $comment)
    {
        // Delete comment (Admin feature)
    }
}
