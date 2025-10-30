<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Requests\PutMovieRequest;
use App\Models\Movie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $genre = $request->query('genre');
        
        if ($genre) {
            $movies = Movie::all()->filter(function ($movie) use ($genre) {
                return collect($movie->genre)->contains(function ($g) use ($genre) {
                    return strtolower($g) === strtolower($genre);
                });
            })->values();
            
            return response()->json($movies);
        }
        
        $movies = Movie::all();
        return response()->json($movies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request): JsonResponse
    {
        $movie = Movie::create($request->validated());
        return response()->json($movie, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $movie = Movie::find($id);
        
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }
        
        return response()->json($movie);
    }

    /**
     * Update the specified resource in storage (PUT - complete update).
     */
    public function update(PutMovieRequest $request, string $id): JsonResponse
    {
        $movie = Movie::find($id);
        
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }
        
        $movie->update($request->validated());
        return response()->json($movie);
    }

    /**
     * Partially update the specified resource in storage (PATCH).
     */
    public function updatePartial(UpdateMovieRequest $request, string $id): JsonResponse
    {
        $movie = Movie::find($id);
        
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }
        
        $movie->update($request->validated());
        return response()->json($movie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $movie = Movie::find($id);
        
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }
        
        $movie->delete();
        return response()->json(['message' => 'Movie deleted']);
    }
}
