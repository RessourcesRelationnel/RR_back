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
        $newCategories = new Category($validateCategories);
        $newCategories->save();
        return response()->json($newCategories, Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show(category $categories)
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
    public function update(UpdatecategoriesRequest $request, category $category)
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
    public function destroy(category $category)
    {
        $category->delete();
        return response()->json($category::all());
    }
}
