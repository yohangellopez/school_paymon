<?php

namespace Database\Factories;

use App\Enum\Course\CourseModalityEnum;
use App\Models\Academy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'academy_id' => Academy::factory(),
            'name' => $this->faker->unique()->words(3, true),
            'description' => $this->faker->paragraph,
            'cost' => $this->faker->randomFloat(2, 50, 500),
            'duration_hours' => $this->faker->numberBetween(20, 100),
            'modality' => $this->faker->randomElement(CourseModalityEnum::values())
        ];
    }
}
