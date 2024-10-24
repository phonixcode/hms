<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company,
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['pending', 'in-progress', 'completed']),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->optional()->date,
            'user_id' => User::factory(),
        ];
    }
}
