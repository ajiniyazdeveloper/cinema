<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $query = Movie::with('genres');

        // Janr bo‘yicha filter
        if ($request->filled('genre_id')) {
            $query->whereHas('genres', function ($q) use ($request) {
                $q->where('genres.id', $request->genre_id);
            });
        }

        // Yil bo‘yicha filter
        if ($request->filled('year')) {
            $query->where('release_year', $request->year);
        }

        // Davlat bo‘yicha filter
        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        // Reyting bo‘yicha tartiblash
        if ($request->filled('sort') && $request->sort === 'rating') {
            $query->withAvg('ratings', 'rating')->orderByDesc('ratings_avg_rating');
        }

        $movies = $query->paginate(12);
        $genres = Genre::all();

        return view('movies.index', compact('movies', 'genres'));
    }

    // Movie details page
    public function show(Movie $movie)
    {
        $movie->load('genres', 'ratings.user');
        return view('movies.show', compact('movie'));
    }

    // Foydalanuvchi reyting qo‘shish
    public function rate(Request $request, Movie $movie)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $movie->ratings()->updateOrCreate(
            ['user_id' => $request->user()->id],
            ['rating' => $request->rating]
        );

        return back()->with('success', 'Reyting qo‘shildi!');
    }
}
