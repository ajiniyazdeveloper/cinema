<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Misol janrlarni tekshiramiz yoki yaratamiz
        $genres = ['Action', 'Comedy', 'Drama', 'Horror', 'Sci-Fi', 'Romance'];
        foreach ($genres as $name) {
            Genre::firstOrCreate(['name' => $name]);
        }

        $genreIds = Genre::pluck('id')->toArray();

        // Movie lar yaratish
        $movies = [
            [
                'title' => 'Avatar',
                'description' => 'Futuristic sci-fi adventure.',
                'release_year' => 2009,
                'country' => 'USA',
                'poster' => 'https://cdn.pixabay.com/photo/2015/03/26/09/41/avatar-690713_1280.jpg',
            ],
            [
                'title' => 'Inception',
                'description' => 'Mind-bending thriller about dreams.',
                'release_year' => 2010,
                'country' => 'USA',
                'poster' => 'https://cdn.pixabay.com/photo/2017/08/30/01/05/cinema-2699066_1280.jpg',
            ],
            [
                'title' => 'Interstellar',
                'description' => 'Epic space journey to save humanity.',
                'release_year' => 2014,
                'country' => 'USA',
                'poster' => 'https://upload.wikimedia.org/wikipedia/en/b/bc/Interstellar_film_poster.jpg',
            ],
            [
                'title' => 'The Godfather',
                'description' => 'Classic mafia drama.',
                'release_year' => 1972,
                'country' => 'USA',
                'poster' => 'https://upload.wikimedia.org/wikipedia/en/1/1c/Godfather_ver1.jpg',
            ],
        ];

        foreach ($movies as $data) {
            $movie = Movie::create($data);

            // Har bir movie uchun 1-3 random janr qo‘shamiz
            $movieGenres = collect($genreIds)->random(rand(1, 3))->toArray();
            $movie->genres()->sync($movieGenres);

            // Har bir movie uchun random ratinglar qo‘shamiz
            $users = User::all();
            foreach ($users as $user) {
                Rating::create([
                    'user_id' => $user->id,
                    'movie_id' => $movie->id,
                    'rating' => rand(1, 5),
                ]);
            }
        }
    }
}
