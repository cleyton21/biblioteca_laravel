<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LivroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Livro::factory(100)->create();
        
    }
}
