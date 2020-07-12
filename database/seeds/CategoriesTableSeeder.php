<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Framework', 'Blog', 'Serve', 'Html', 'Tutorial', 'Daily life', 'Laravel', 'Css', 'Tips trik'];
        $collection = collect($categories);

        $collection->each(function($c){
            Category::create([
                'name' => $c,
                'slug' => Str::slug($c)
            ]);
        });
    }
}
