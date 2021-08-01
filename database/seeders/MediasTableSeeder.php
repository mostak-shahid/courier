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
        Media::create([
            'user_id' => '1',
            'title' => 'Placeholder Image',
            'slug' => 'placeholder',
            'url' => 'uploads/placeholder.png',
            'type' => 'image/png',
        ]);
        Media::create([
            'user_id' => '1',
            'title' => 'Default Avatar',
            'slug' => 'avatar',
            'url' => 'uploads/avatar.png',
            'type' => 'image/png',
        ]);
        Media::create([
            'user_id' => '1',
            'title' => 'Default Logo',
            'slug' => 'logo',
            'url' => 'uploads/logo.png',
            'type' => 'image/png',
        ]);
        Media::create([
            'user_id' => '1',
            'title' => 'Default Fav',
            'slug' => 'fav',
            'url' => 'uploads/fav.png',
            'type' => 'image/png',
        ]);
    }
}
