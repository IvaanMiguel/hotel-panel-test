<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = Blog::factory()->count(50)->create();

        foreach($blogs as $blog){
            $blog->hotels()->attach(Hotel::all()->random()->id);
        }
    }
}
