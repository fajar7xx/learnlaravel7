<?php

use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'how to', 'tips' , 'trik', 'linux', 'devops' , '2020', 'laravel eloquent', 'laravel tutorial', 'wordpress optimization', 'create database', 'laravel project'
        ];
        $collection = collect($tags);
        $collection->each(function($e){
            Tag::create([
                'name' => $e,
                'slug' => Str::slug($e)
            ]);
        });
    }
}
