<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::create([
            'user_id' => 1,
            'key' => 'mobile',
            'value' => '01710702212'
        ]);
    }
}
