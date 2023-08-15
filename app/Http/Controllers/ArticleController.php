<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; // Assuming your Article model is named 'Article'
use App\Http\Resources\ArticleResource;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate(10); // Change the number per page as needed
        return ArticleResource::collection($articles);
    }

    public function create()
    {
        if (Gate::allows('isAdmin')) {
            return view('articles.create');
        } else {
            return redirect()->route('articles.index')->with('error', 'You are not authorized to create articles.');
        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            $data = $request->validate([
                 'title' => 'required|string',
                 'content' => 'required|string',
                 'publish_date' => 'required|date',
                 'author_id' => 'required|exists:authors,id',
                 'category_id' => 'required|exists:categories,id',
                 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
             ]);

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('article_images', 'public');
                $data['image'] = $imagePath;
            }

            Article::create($data);

            return redirect()->route('articles.index')->with('success', 'Article created successfully.');
        } else {
            return redirect()->route('articles.index')->with('error', 'You are not authorized to create articles.');
        }

    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return new ArticleResource($article);
    }

    public function edit(Article $article)
    {
        if (Gate::allows('isAdmin')) {
            return view('articles.edit', compact('article'));
        } else {
            return redirect()->route('articles.index')->with('error', 'You are not authorized to edit articles.');
        }
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'publish_date' => 'required|date',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('article_images', 'public');
            $data['image'] = $imagePath;
        }

        $article->update($data);

        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }

}
