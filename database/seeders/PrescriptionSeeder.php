<?php

namespace Database\Seeders;

use App\Models\Prescription;
use Illuminate\Database\Seeder;

class PrescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title = ['OTC', 'RX', 'БАД'];

        for($i = 0; $i<count($title); $i++) {
            $prescription = new Prescription();
            $prescription->title = $title[$i];
            $prescription->save();
        }
    }
}
