<?php

namespace Database\Seeders;

use App\Models\Impact;
use Illuminate\Database\Seeder;

class ImpactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title = ['Глаза', 'Ухо', 'Горло', 'Нос', 'Витамины'];
        $highlight = [false, true, true, true, true];

        for($i = 0; $i<count($title); $i++) {
            $impact = new Impact();
            $impact->title = $title[$i];
            $impact->highlight = $highlight[$i];
            $impact->save();
        }
    }
}
