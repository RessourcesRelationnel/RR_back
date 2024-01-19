<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StorearticlesRequest;
use App\Http\Requests\UpdatearticlesRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ArticlesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $articles = Article::where('validated', true)->get();
        return response()->json(['success'=> $articles], Response::HTTP_OK);
    }

    public function store(StorearticlesRequest $request)
    {
        $user = Auth::user();
        $articles = $user->articles()->where('validated', false)->get();

        if(count($articles) < 1){
            $validatedData = $request->validated();
            $article = new Article($validatedData);
            $article->user_id = Auth::user()->id;
           $categories_id =  json_decode($request['categories_id']);
           foreach ($categories_id as $category) {
                if (Category::find($category))  {
                $article->categories()->attach($category);
                }
                else{
                }
            }
            $article->save();

        }else{
            return response()->json(['erreur' => 'Un article est déjà en attente de validation'],200 );
        }
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Article $article)
    {
        return response()->json($article, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatearticlesRequest  $request
         * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatearticlesRequest $request, Article $article)
    {
        if ($article['user_id'] == Auth::user()){
            $validatedData = $request->validated();
            $validatedData['validated'] = false;
            $article->update($validatedData);
            return response()->json($article, Response::HTTP_ACCEPTED);
        }
        return response()->json($article, Response::HTTP_ACCEPTED);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json($article::all());
    }
}
