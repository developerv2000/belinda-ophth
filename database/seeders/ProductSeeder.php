<?php

namespace Database\Seeders;

use App\Helpers\Helper;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ['Отибелс', 'Истаран', 'Визиолайт Кидс', 'Назатек', 'Назасофт бэби капли', 'Дорсоб-Т'];
        $description = '<p>Местный противовоспалительный, анальгезирующий антисептик.</p>';
        $body = '<h2>Показания к применению</h2><ul><li>инфекционно-воспалительные заболевания полости рта и глотки, в т.ч. ангины, тонзиллиты, тонзилофарингиты, глосситы, стоматиты, афты;</li><li>для обработки полости рта и глотки при хирургических вмешательствах на дыхательных путях и полости рта и в послеоперационном периоде;</li><li>для лечения инфекций полости рта и горла, возникающих при химиотерапии;</li><li>при стрептококковых ангинах применяется как дополнительное средство при лечении антибиотиками.</li></ul><p></p><h2>Способ применения</h2><p>Спрей применяют местно на слизистую оболочку полости рта и глотки. Перед первым применением препарата несколько раз нажать на распылитель до появления дисперсной струи.</p><p>Перед дальнейшим применением сделать 2-3 нажатия, чтобы раствор попал в распылитель и после нажатия разбрызгивался, после чего препарат можно применять.</p><p>Применять препарат следует, как правило, 2-3 раза в сутки, по одному впрыскиванию направо и налево в полость рта и глотки. В момент впрыскивания необходимо задержать дыхание. Аппликатор до и после применения промывают горячей водой.</p>';
        $image = ['1.png', '2.png', '3.png', '4.png', '5.png', '6.png'];
        $instruction = '1.pdf';
        $obtain_link = ['https://salomat.tj', '', 'https://salomat.tj', '', 'https://salomat.tj', ''];

        for($i=0; $i<count($name); $i++) {
            $product = new Product();
            $product->name = $name[$i];
            $product->url = Helper::transliterateIntoLatin($product->name);
            $product->description = $description;
            $product->body = $body;
            $product->form_id = rand(1, 2);
            $product->impact_id = rand(1, 2);
            $product->prescription_id = rand(1, 3);
            $product->image = $image[$i];
            $product->instruction = $instruction;
            $product->obtain_link = $obtain_link[$i];
            $product->save();

            $product->substances()->attach(rand(1,2));
        }
    }
}
