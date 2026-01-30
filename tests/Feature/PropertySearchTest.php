<?php

namespace Tests\Feature;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertySearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_all_properties_as_array(): void
    {
        Property::factory()->count(20)->create();

        $response = $this->getJson('/api/properties/search');

        $response->assertOk()
            ->assertJsonIsArray()
            ->assertJsonCount(20);
    }

    public function test_filters_by_name(): void
    {
        Property::factory()->create(['name' => 'Beach House']);
        Property::factory()->create(['name' => 'Mountain Cabin']);

        $response = $this->getJson('/api/properties/search?name=Beach');

        $response->assertOk()
            ->assertJsonCount(1)
            ->assertJsonPath('0.name', 'Beach House');
    }

    public function test_filters_by_bedrooms(): void
    {
        Property::factory()->create(['bedrooms' => 3]);
        Property::factory()->create(['bedrooms' => 5]);

        $response = $this->getJson('/api/properties/search?bedrooms=3');

        $response->assertOk()
            ->assertJsonCount(1)
            ->assertJsonPath('0.bedrooms', 3);
    }

    public function test_filters_by_price_range(): void
    {
        Property::factory()->create(['price' => 100000]);
        Property::factory()->create(['price' => 300000]);
        Property::factory()->create(['price' => 500000]);

        $response = $this->getJson('/api/properties/search?price_min=150000&price_max=400000');

        $response->assertOk()
            ->assertJsonCount(1)
            ->assertJsonPath('0.price', 300000);
    }

    public function test_filters_by_multiple_criteria(): void
    {
        Property::factory()->create([
            'bedrooms' => 3,
            'bathrooms' => 2,
            'garages' => 1,
        ]);
        Property::factory()->create([
            'bedrooms' => 3,
            'bathrooms' => 1,
            'garages' => 2,
        ]);

        $response = $this->getJson('/api/properties/search?bedrooms=3&bathrooms=2');

        $response->assertOk()
            ->assertJsonCount(1)
            ->assertJsonPath('0.bathrooms', 2);
    }

    public function test_validates_invalid_bedrooms(): void
    {
        $response = $this->getJson('/api/properties/search?bedrooms=invalid');

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['bedrooms']);
    }

    public function test_validates_negative_price(): void
    {
        $response = $this->getJson('/api/properties/search?price_min=-100');

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['price_min']);
    }

    public function test_returns_empty_array_when_no_matches(): void
    {
        Property::factory()->create(['bedrooms' => 2]);

        $response = $this->getJson('/api/properties/search?bedrooms=5');

        $response->assertOk()
            ->assertJsonIsArray()
            ->assertJsonCount(0);
    }

    public function test_does_not_expose_timestamps(): void
    {
        Property::factory()->create();

        $response = $this->getJson('/api/properties/search');

        $response->assertOk()
            ->assertJsonMissingPath('0.created_at')
            ->assertJsonMissingPath('0.updated_at');
    }

    public function test_returns_only_required_fields(): void
    {
        Property::factory()->create();

        $response = $this->getJson('/api/properties/search');

        $response->assertOk()
            ->assertJsonStructure([
                '*' => ['id', 'name', 'price', 'bedrooms', 'bathrooms', 'storeys', 'garages'],
            ]);
    }

    public function test_numeric_fields_are_integers(): void
    {
        Property::factory()->create([
            'price' => 500000,
            'bedrooms' => 3,
        ]);

        $response = $this->getJson('/api/properties/search');
        $data = $response->json();

        $this->assertIsInt($data[0]['price']);
        $this->assertIsInt($data[0]['bedrooms']);
        $this->assertIsInt($data[0]['bathrooms']);
        $this->assertIsInt($data[0]['storeys']);
        $this->assertIsInt($data[0]['garages']);
    }
}
