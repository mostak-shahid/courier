<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;
class MediasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * $table->foreignId('user_id');
            $table->string('title');
            $table->string('slug');
            $table->string('url');
            $table->string('type');
         * */
        Media::create([
            'user_id' => '1',
            'title' => 'Placeholder Image',
            'slug' => 'placeholder',
            'url' => 'uploads/placeholder.png',
            'type' => 'image/png',
        ]);
    }
}
