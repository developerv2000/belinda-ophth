<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@mail.ru';
        $user->password = bcrypt('12345');
        $user->save();

        $this->call(SlideSeeder::class);
        $this->call(ResearchSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(FormSeeder::class);
        $this->call(ImpactSeeder::class);
        $this->call(SubstanceSeeder::class);
        $this->call(PrescriptionSeeder::class);
    }
}