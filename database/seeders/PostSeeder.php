<?php
namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 5 users with 3 posts each
        User::factory()
            ->count(5)
            ->create()
            ->each(function ($user) {
                Post::factory()
                    ->count(3)
                    ->create([
                        'user_id' => $user->id
                    ]);
            });
    }
}
