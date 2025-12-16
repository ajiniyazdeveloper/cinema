<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $movies = Movie::all();

        foreach ($users as $user) {
            foreach ($movies as $movie) {
                Rating::create([
                    'user_id' => $user->id,
                    'movie_id' => $movie->id,
                    'rating' => rand(3, 5),
                ]);
            }
        }
    }
}
