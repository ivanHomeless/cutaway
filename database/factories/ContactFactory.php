<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'example' => $this->faker->word(),
            'logo' => 'logo/logo.svg',
            'main_link' => 'https://t-do.ru/lifehackerru/',
            'main_text' => $this->faker->word(),
            'background_color' => $this->faker->hexColor,
            'color' => '#FFFFFF',
        ];
    }
}
