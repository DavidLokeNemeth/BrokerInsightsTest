<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Converter;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConverterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_converter()
    {
        // Arrange
        $converterData = [
            'broker_id' => 1,
            'key_name' => 'test_key',
            'broker_call' => 'test_broker_call',
        ];

        // Act
        $converter = Converter::create($converterData);

        // Assert
        $this->assertInstanceOf(Converter::class, $converter);
        $this->assertDatabaseHas('converters', $converterData);
    }

    /** @test */
    public function it_can_update_a_converter()
    {
        // Arrange
        $converterData = [
            'broker_id' => 1,
            'key_name' => 'test_key',
            'broker_call' => 'test_broker_call',
        ];

        $updatedData = [
            'broker_id' => 2,
            'key_name' => 'updated_key',
            'broker_call' => 'updated_broker_call',
        ];

        $converter = Converter::create($converterData);

        // Act
        $converter->update($updatedData);

        // Assert
        $this->assertEquals($updatedData['broker_id'], $converter->fresh()->broker_id);
        $this->assertEquals($updatedData['key_name'], $converter->fresh()->key_name);
        $this->assertEquals($updatedData['broker_call'], $converter->fresh()->broker_call);
    }

    /** @test */
    public function it_can_delete_a_converter()
    {
        // Arrange
        $converterData = [
            'broker_id' => 1,
            'key_name' => 'test_key',
            'broker_call' => 'test_broker_call',
        ];

        $converter = Converter::create($converterData);

        // Act
        $converter->delete();

        // Assert
        $this->assertDatabaseMissing('converters', $converterData);
    }
}
