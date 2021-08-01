<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = array(
            array(
                'key'=> 'company_name',
                'value' => 'Mos Courier',
            ),
            array(
                'key'=> 'company_logo',
                'value' => 3,
            ),
            array(
                'key'=> 'company_favicon',
                'value' => 4,
            ),
        );
        foreach($arr as $data){
            Setting::create([
                'key' => $data['key'],
                'value' => $data['value'],
            ]);
        }        
    }
}
