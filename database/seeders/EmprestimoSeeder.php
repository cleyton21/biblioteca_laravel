<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmprestimoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Emprestimo::factory(30)->create();
    }
}
