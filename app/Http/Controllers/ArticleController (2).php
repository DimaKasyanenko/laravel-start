<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::query()
                           ->select(['id', 'title', 'thumbnail' , 'created_at',
                               'user_id'])
                           ->with(['user:id,name'])
                           ->withCount('comments')
                           ->latest()
                           ->paginate(5);

        return view('articles.index', [
            'articles' => $articles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->form(new Article());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        Article::query()->create($request->validated());

        return redirect()->route('articles.index')->with(
            'message', 'Статья добавлена'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return $this->form($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $data['thumbnail'] = $file->storeAs('images', $file->getClientOriginalName());
        }

        $article->update($data);

        return redirect()
            ->route('articles.index')
            ->with('message', 'Статья обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')->with(
            'message', 'Статья удалена'
        );
    }

    private function form(Article $article)
    {
        $users = User::query()->pluck('name', 'id')->toArray();

        return view('articles.form', ['users' => $users, 'article' => $article]
        );
    }
}
