<?php

namespace App\Http\Controllers;

use App\Http\Requests\article\StorearticlesRequest;
use App\Http\Requests\article\UpdatearticlesRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use Symfony\Component\HttpFoundation\Response;

class ArticlesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexArticleValidated()
    {
        $articles = Article::where('validated', true)->get();
        return response()->json(['success'=> $articles], Response::HTTP_OK);
    }

    public function indexArticleNotValidated()
    {
        $articles = Article::where('validated', false)->get();
        return response()->json(['success'=> $articles], Response::HTTP_OK);
    }

    public function store(StorearticlesRequest $request)
    {
        $user = Auth::user();
        $articles = $user->articles()->where('validated', false)->get();

        if(count($articles) < 1){
            $validatedData = $request->validated();
//            $article = new Article($validatedData);

            try {
                $article = Article::create([
                    'title' => $validatedData['title'],
                    'content' => $validatedData['content'],
                    'user_id' => $user->id,
                    'validated' => 0
                ]);
            }catch (\Exception $e){
                return response()->json(['error' => $e->getMessage()], 500);
            }

            $categories_id = json_decode($validatedData['categories']);

            // Si $categories_id n'est pas déjà un tableau, on le convertit en un tableau contenant une seule valeur
            if (!is_array($categories_id)) {
                $categories_id = [$categories_id];
            }

            foreach ($categories_id as $category) {
                $article->categories()->attach($category);
            }

            return response()->json(['success' => 'Article créer'],200 );
        }else{
            return response()->json(['erreur' => 'Un article est déjà en attente de validation'],500 );
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
     * @param  \App\Http\Requests\article\UpdatearticlesRequest  $request
         * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatearticlesRequest $request, Article $article)
    {
        if ($article->user_id === Auth::user()->id){
            $validatedData = $request->validated();
            $article->update($validatedData, ['validated' => 0]);
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
        try {
            $article->delete();
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([Article::all(), 'Suppression réussi'], 200);
    }
}
