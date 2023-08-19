<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        User::create([
            'name' => 'Administrator',
            'username' => 'Admin',
            'alamat' => 'Payakumbuh',
            'email' => 'adminppid@gmail.com',
            'password' => bcrypt('password'),
            'level' => 1,
            'img' => 'user.png'
        ]);
        // User::factory(3)->create();
        User::create([
            'name' => 'Muhammad Ega Dermawan',
            'username' => 'muhammad-ega-dermawan',
            'alamat' => 'Payakumbuh',
            'email' => 'dermawane988@gmail.com',
            'password' => bcrypt('password'),
            'level' => 3,
            'img' => 'user.png'
        ]);
        User::create([
            'name' => 'Fahmi Abdul Aziz',
            'username' => 'fahmi-abdul-aziz',
            'alamat' => 'Payakumbuh',
            'email' => 'fahmi@gmail.com',
            'password' => bcrypt('password'),
            'level' => 2,
            'img' => 'user.png'
        ]);

        Post::create([
            'title' => 'Ada Luffy Gear 5, Ini Spoiler Anime One Piece 1071',
            'slug' => 'ada-luffy-gear-5-,-ini-spoiler-anime-one-piece-1071',
            'content' => 'asd',
            'image' => 'images/IPYs04MrS4JriiEdkHRf3BcRl3F88oOrsWpi3Odx.jpg',
            'user_id' => 1,
            'category_id' => 1,
            'post_tag' => "anime,one piece,luffy"
        ]);

        Category::create([
            'name' => 'Hiburan',
            'slug' => 'hiburan'
        ]);
        Category::create([
            'name' => 'News',
            'slug' => 'news'
        ]);
        Category::create([
            'name' => 'Kuliner',
            'slug' => 'kuliner'
        ]);

        // Post::factory(20)->create();
    }
}
