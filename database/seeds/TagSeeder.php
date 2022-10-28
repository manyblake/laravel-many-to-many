<?php

use Illuminate\Database\Seeder;
use App\Tag;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['Avventura', 'Calcio', 'Vegan', 'Tech', 'News', 'Streaming', 'Salute', 'Vacanze', 'Sicurezza', 'Comicità', 'Natura'];

        foreach ($tags as $name) {
            $t = new Tag();

            $t->name = $name;
            $t->slug = Str::slug($name);

            $t->save();
        }
    }
}
