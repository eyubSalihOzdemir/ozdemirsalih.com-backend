<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Filters\V1\ArticlesFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ArticleResource;
use App\Http\Resources\V1\ArticleCollection;
use App\Http\Requests\V1\StoreArticleRequest;
use App\Http\Requests\V1\UpdateArticleRequest;

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
        
        $query = Article::query()->where($filterItems);
        // $query->select('id', 'title', 'category_id', 'description', 'thumbnail', 'created_at', 'updated_at');

        return new ArticleCollection($query->paginate()->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        // Laravel automatically handles the validation because of the mentioned StoreArticleRequest class.
        $validatedArticle = Article::create($request->all());

        return new ArticleResource($validatedArticle);

        // try {
        //     $article = Article::create($request->validated()); // Create article using validated data

        //     return response()->json(['message' => 'Article created successfully', 'article' => $article], 201); 
        // } catch($e) {
        //     return response()->json(['errors' => $e->validator->getMessageBag()], 422);
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return new ArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $article->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json([
            'message' => 'Article deleted successfully!' 
        ]);
    }

    public function assignApiTokenManually($userId)
    {
        $user = User::find($userId);

        if ($user) {
            $apiToken = $user->createToken('admin-token')->plainTextToken;
            //$user->api_token = $apiToken;
            $user->save();
            return response()->json(['api_token' => $apiToken], 200);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}


