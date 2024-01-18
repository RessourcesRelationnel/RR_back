<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StorearticlesRequest;
use App\Http\Requests\UpdatearticlesRequest;
use App\Models\Sondage;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
    public function getMySondage()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $articles = $user->articles()->pluck('id');
            $sondages = Article::whereIn('id', $articles)->get();
            return $sondages;
        }else {
            return response()->json([
                "error" => "Vous n'êtes pas connecté",
            ], 401);
        }
    }
    public function store(StorearticlesRequest $request)
    {

           $validatedData = $request->validated();

            return response()->json(['test' => $validatedData]);
    }

    /**
     * Display the specified resource.
     */
    public function show(article $Article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(article $articles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatearticlesRequest $request, article $articles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(article $articles)
    {
        //
    }
}
