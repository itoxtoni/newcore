<?php

namespace Database\Seeders;

use App\Dao\Models\Core\SystemMenu;
use App\Dao\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        SystemMenu::create([
            'system_menu_code' => 'event',
            'system_menu_name' => 'Event',
            'system_menu_url' => 'event',
            'system_menu_controller' => 'App\\Http\\Controllers\\EventController',
            'system_menu_action' => 'event.getTable',
            'system_menu_type' => 1,
            'system_menu_sort' => 9,
            'system_menu_description' => null,
            'system_menu_enable' => null,
            'system_menu_can_delete' => 1,
        ]);

        DB::table('system_group_connection_menu')->insert([
            0 => [
                'system_group_code' => 'aplikasi',
                'system_menu_code' => 'event',
            ],
        ]);

        $loop = ['10K', '17K', '21K', '42K'];

        foreach ($loop as $key => $value) {
            Event::create([
                'event_name' => $value,
                'event_price' => '50000',
                'event_date' => date('Y-m-d'),
                'event_image' => '',
                'event_info' => 'Start 06:00 AM - Until Finish',
                'event_description' => 'Tahura Run '.$value,
            ]);
        }

        Event::create([
            'event_name' => '10K Fun trail',
            'event_price' => '100000',
            'event_date' => date('Y-m-d'),
            'event_image' => '',
            'event_info' => 'Start 06:00 AM - Until Finish',
            'event_description' => 'Tahura Run 10K Fun trail',
        ]);

        Event::create([
            'event_name' => '5K Family',
            'event_price' => '100000',
            'event_date' => date('Y-m-d'),
            'event_image' => '',
            'event_info' => 'Start 06:00 AM - Until Finish',
            'event_description' => 'Tahura Run 5K Family',
        ]);
    }
}