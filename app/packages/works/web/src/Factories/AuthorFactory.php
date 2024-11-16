<?php

namespace Works\Web\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Works\Web\Models\Author;

class AuthorFactory extends Factory
{
    protected $model = Author::class;

    public function definition()
    {
        return [
            'website_id' => 1,
            'username' => $this->faker->userName,
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'links' => json_encode([
                'twitter' => $this->faker->url, 
                'github' => $this->faker->url
            ]),
            'photo' => $this->faker->imageUrl(200, 200, 'people'),
            'biography' => $this->faker->paragraph,
            'slug' => $this->faker->slug,
        ];
    }
}
