<?php

namespace Database\Seeders;

use App\Models\Form;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title = ['Таблетки', 'Спрей', 'Капсулы', 'Ампулы', 'Глазные капли'];

        for($i = 0; $i<count($title); $i++) {
            $form = new Form();
            $form->title = $title[$i];
            $form->save();
        }
    }
}
