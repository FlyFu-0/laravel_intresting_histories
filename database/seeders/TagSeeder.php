<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Faker\Core\Color;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colorFaker = new Color();

        $tag = new Tag();
        $tag->name = 'IT';
        $tag->color = $colorFaker->safeColorName();
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Cars';
        $tag->color = $colorFaker->safeColorName();
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Nature';
        $tag->color = $colorFaker->safeColorName();
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Business';
        $tag->color = $colorFaker->safeColorName();
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Gadgets';
        $tag->color = $colorFaker->safeColorName();
        $tag->save();
    }
}
