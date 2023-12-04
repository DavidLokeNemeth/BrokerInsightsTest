<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Broker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrokerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_broker()
    {
        // Arrange
        $brokerData = [
            'broker_name' => 'Test Broker',
        ];

        // Act
        $broker = Broker::create($brokerData);

        // Assert
        $this->assertInstanceOf(Broker::class, $broker);
        $this->assertDatabaseHas('brokers', $brokerData);
    }

    /** @test */
    public function it_can_update_a_broker()
    {
        // Arrange
        $originalData = [
            'broker_name' => 'Original Broker',
        ];

        $updatedData = [
            'broker_name' => 'Updated Broker',
        ];

        $broker = Broker::create($originalData);

        // Act
        $broker->update($updatedData);

        // Assert
        $this->assertEquals($updatedData['broker_name'], $broker->fresh()->broker_name);
        $this->assertDatabaseHas('brokers', $updatedData);
    }

    /** @test */
    public function it_can_delete_a_broker()
    {
        // Arrange
        $brokerData = [
            'broker_name' => 'Broker to be deleted',
        ];

        $broker = Broker::create($brokerData);

        // Act
        $broker->delete();

        // Assert
        $this->assertDatabaseMissing('brokers', $brokerData);
    }
}
