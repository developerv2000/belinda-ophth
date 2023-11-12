<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Seeder;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title = ['Мы гарантируем'];
        $body = ['Безопасность, эффективность и качество
препаратов и их влияние на организм'];
        $image = ['1.png'];
        $button = ['Перейти к продуктам'];
        $link = ['/products'];

        for($i = 0; $i<count($title); $i++) {
            $slide = new Slide();
            $slide->title = $title[$i];
            $slide->body = $body[$i];
            $slide->image = $image[$i];
            $slide->link = $link[$i];
            $slide->button = $button[$i];
            $slide->priority = $i;
            $slide->save();
        }
    }
}
