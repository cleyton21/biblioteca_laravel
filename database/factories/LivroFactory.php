<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LivroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence($nbWords = 3, $variableNbWords = true);
        $slug = Str::of($title)->slug('-');

        return [
            'isbn' => $this->faker->numerify('#############'),
            'titulo' => $title,
            'subtitulo' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'slug' => $slug,
            'descricao' => $this->faker->sentence($nbWords = 20, $variableNbWords = true),
            'quantidade' => $this->faker->randomDigitNot(0) 
        ];
    }
}
