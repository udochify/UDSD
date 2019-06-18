<?php

use App\Comment;

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->truncate();

        $faker = \Faker\Factory::create();

        foreach(range(1,30) as $index)
        {
            Comment::create([
                'postid'=> rand(1, 30),
                'commenter'=> $faker->sentence(1),
                'comment'=> $faker->paragraphs(2, true),
            ]);
        }   
    }
}
