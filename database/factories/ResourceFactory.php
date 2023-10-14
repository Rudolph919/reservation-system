<?php

namespace Database\Factories;

use App\Models\Resource;
use App\Models\ResourceType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resource>
 */
class ResourceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resource::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $resourceTypes = ResourceType::all();
        $resourceTypeId = $resourceTypes->random()->id;

        return [
            'name' => $this->faker->company() . ' ' . $this->faker->randomElement(['Hotel', 'Motel', 'Resort']),
            'description' => $this->faker->text(),
            'resource_type_id' => $resourceTypeId,
            'capacity' => $this->faker->numberBetween(1, 30),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'location' => $this->faker->address(),
            'image' => $this->faker->imageUrl(640, 480),
        ];
    }
}
