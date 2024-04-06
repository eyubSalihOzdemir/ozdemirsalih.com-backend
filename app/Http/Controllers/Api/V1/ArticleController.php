<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Filters\V1\ArticlesFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Resources\V1\ArticleResource;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\V1\ArticleCollection;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // filtering example:
        // http://localhost:8000/api/v1/articles?title[eq]=Et%20quaerat%20doloremque%20qui%20totam.

        $filter = new ArticlesFilter();
        $filterItems = $filter->transform($request); //[['column', 'operator', 'value']]

        $articles = Article::where($filterItems);

        return new ArticleCollection($articles->paginate()->appends($request->query()));
        // if (count($filterItems) == 0) {
        //     // return Article::all();
        //     return new ArticleCollection(Article::paginate());
        // } else {
        //     $articles = Article::where($filterItems)->paginate();

        //     return new ArticleCollection($articles->appends($request->query()));
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        // return $article;
        return new ArticleResource($article);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
