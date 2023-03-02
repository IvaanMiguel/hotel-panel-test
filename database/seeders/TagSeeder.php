<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tag = new Tag();
        $tag->name = "Tag 1";
        $tag->save();

        $tag = new Tag();
        $tag->name = "Tag 2";
        $tag->save();

        $tag = new Tag();
        $tag->name = "Tag 3";
        $tag->save();

        $tag = new Tag();
        $tag->name = "Tag 4";
        $tag->save();
    }
}
