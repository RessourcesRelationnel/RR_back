<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Commentary;
use App\Http\Requests\StorecommentariesRequest;
use App\Http\Requests\UpdatecommentariesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CommentariesController extends Controller
{
    public function index(Article $article)
    {
        $commentaries = Commentary::where('article_id', $article->id)->get();

        return response()->json(['response' => $commentaries]);
    }

    public function store (Article $article, StorecommentariesRequest $request)
    {
        $validatedData = $request->validated();
        $commentary = new Commentary($validatedData);
        $commentary->user_id = Auth::user()->id;
        $commentary->article_id = $article->id;
        $commentary->save();

        return response()->json(["success" => 'Commentaire  " ' . $commentary['comment'] . ' " créer avec succès'], Response::HTTP_CREATED);
    }

    public function update(Commentary $commentary, UpdatecommentariesRequest $request)
    {
        if ($commentary['user_id']!= Auth::user()->id){

            $validateArticle = $request->validated();
            $commentary->update($validateArticle);
            return response()->json($commentary, Response::HTTP_ACCEPTED);
        };
        return response()->json(['commentaire'=>"User invalide"], Response::HTTP_ACCEPTED);

    }


    /**
     * Update the specified resource in storage.
     */
    public function destroy(Category $commentary)
    {
        //
    }
}
