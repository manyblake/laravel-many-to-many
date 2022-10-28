<?php

use App\Category;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;
use Illuminate\Support\Str;
use App\Tag;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categoryId = Category::all()->pluck('id');
        $tags = Tag::all()->pluck('id');

        for ($i = 0; $i < 50; $i++) {
            $post = new Post();
            $post->title = $faker->words(rand(5, 10), true);
            $post->content = $faker->paragraphs(rand(10, 20), true);
            $post->slug = Str::slug($post->title);
            $post->category_id = $faker->optional()->randomElement($categoryId);

            $coverId = $faker->optional()->numberBetween(200, 500);
            if ($coverId) {
                $post->cover = 'https://picsum.photos/' . $coverId;
            }

            $post->save();

            $tagIds = $tags->shuffle()->take(rand(1, 4))->all();
            $post->tags()->sync($tagIds);
        }
    }
}
