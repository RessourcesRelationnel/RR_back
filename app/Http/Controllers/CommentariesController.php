<?php

namespace App\Http\Controllers;

use App\Models\commentary;
use App\Http\Requests\StorecommentariesRequest;
use App\Http\Requests\UpdatecommentariesRequest;

class CommentariesController extends Controller
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
    public function store(StorecommentariesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(commentary $commentaries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(commentary $commentaries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecommentariesRequest $request, commentary $commentaries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(commentary $commentaries)
    {
        //
    }
}
