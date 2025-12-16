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

    public function create()
    {
        $genres = Genre::all();
        return view('movies.create', compact('genres'));
    }

    public function store(Request $request)
    {
         // ✅ Validatsiya
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
            'country' => 'required|string|max:100',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
            'poster_file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // max 2MB
        ]);

        // ✅ Poster faylni saqlash
        $posterPath = null;
        if ($request->hasFile('poster_file')) {
            $path = $request->file('poster_file')->store('posters', 'public');
            $posterPath = 'storage/' . $path;
        }

        // ✅ Movie yaratish
        $movie = Movie::create([
            'title' => $request->title,
            'description' => $request->description,
            'release_year' => $request->release_year,
            'country' => $request->country,
            'poster' => $posterPath, // fayl saqlangan bo‘lsa, path
        ]);

        // ✅ Janrlar bilan pivot bog‘lash
        $movie->genres()->sync($request->genres);

        // ✅ Redirect + flash message
        return redirect()->route('movies.index')->with('success', 'Kino muvaffaqiyatli qo‘shildi!');
    }

    public function edit(Movie $movie)
    {
        $genres = Genre::all();
        return view('movies.edit', compact('movie', 'genres'));
    }

    public function update(Request $request, Movie $movie)
    {
        // ✅ Validatsiya
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
            'country' => 'required|string|max:100',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
            'poster_file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ Poster faylni yangilash
        if ($request->hasFile('poster_file')) {
            $path = $request->file('poster_file')->store('posters', 'public');
            $movie->poster = 'storage/' . $path;
        }

        // ✅ Movie ma'lumotlarini yangilash
        $movie->update($request->only([
            'title', 'description', 'release_year', 'country'
        ]));

        // ✅ Janrlar bilan pivot bog‘lash
        $movie->genres()->sync($request->genres);

        // ✅ Redirect + flash message
        return redirect()->route('movies.show', $movie->id)
                        ->with('success', 'Kino muvaffaqiyatli yangilandi!');
    }

    public function destroy(Movie $movie)
    {
        // Avval pivot va ratinglarni tozalaymiz
        $movie->genres()->detach();
        $movie->ratings()->delete();

        $movie->delete();

        return redirect()->route('movies.index')
            ->with('success', 'Kino muvaffaqiyatli o‘chirildi');
    }
}
