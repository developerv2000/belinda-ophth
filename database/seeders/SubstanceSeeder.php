<?php

namespace Database\Seeders;

use App\Models\Substance;
use Illuminate\Database\Seeder;

class SubstanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title = ['Повидон-йод', 'Мометазона фуроат', 'Масло листьев эвкалипта шаровидного ', 'Натрия хлорид', 'Этанол'];

        for($i = 0; $i<count($title); $i++) {
            $substance = new Substance();
            $substance->title = $title[$i];
            $substance->save();
        }
    }
}
