<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Http\Requests\StorecategoriesRequest;
use App\Http\Requests\UpdatecategoriesRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json(['success'=> $categories], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorecategoriesRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorecategoriesRequest $request)
    {
        $validateCategories = $request->validated();
        try {
            $newCategories = new Category($validateCategories);
            $newCategories->save();
        }catch (\Exception $e) {
            // En cas d'exception, renvoyez une réponse JSON avec le message d'erreur et le code de statut HTTP 500 (Erreur interne du serveur)
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json($newCategories, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecategoriesRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatecategoriesRequest $request, Category $category)
    {
        $validateCategory = $request->validated();
        $category->update($validateCategory);
        return response()->json($category, Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json($category::all());
    }
}
