<?php

namespace App\Http\Controllers;

use App\Http\Requests\favori\StorefavoriesRequest;
use App\Http\Requests\favori\UpdatefavoriesRequest;
use App\Models\favorite;

class FavoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorefavoriesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(favorite $favories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(favorite $favories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatefavoriesRequest $request, favorite $favories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(favorite $favories)
    {
        //
    }
}
