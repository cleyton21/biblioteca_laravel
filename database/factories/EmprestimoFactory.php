<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmprestimoFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       $dt_ini = $this->faker->dateTimeBetween($startDate = '-5 days', $endDate = '+ 3 days', $timezone = null);

        return [
            'id_livro' => $this->faker->numberBetween($min = 1, $max = 100),
            'id_user' => $this->faker->numberBetween($min = 1, $max = 10),
            'dt_ini' => $dt_ini,
            'dt_end' => $this->faker->dateTimeBetween($startDate = $dt_ini, $endDate = '+ 10 days', $timezone = null),
            'entregue' => $this->faker->randomElement($array = array ('0','1')),
            'qnt' => 1 
        ];
    }
}
