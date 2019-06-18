<?php

use App\Post;

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['technology', 'local', 'education', 'developer', 'programmer', 'entertainment', 'personal'];

        DB::table('posts')->truncate();

        $faker = \Faker\Factory::create();

        foreach(range(1,30) as $index)
        {
            Post::create([
                'posttype'=> $categories[rand(0, count($categories)-1)],
                'posttitle'=> $faker->sentence(3),
                'post'=> $faker->paragraphs(2, true),
                'author'=> $faker->sentence(1),
            ]);
        }   
    }
}
