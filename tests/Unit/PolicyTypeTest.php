<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\PolicyType;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PolicyTypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_policy_type()
    {
        // Arrange
        $policyTypeData = [
            'policy_type_name' => 'Test Policy Type',
        ];

        // Act
        $policyType = PolicyType::create($policyTypeData);

        // Assert
        $this->assertInstanceOf(PolicyType::class, $policyType);
        $this->assertDatabaseHas('policy_types', $policyTypeData);
    }

    /** @test */
    public function it_can_update_a_policy_type()
    {
        // Arrange
        $policyTypeData = [
            'policy_type_name' => 'Test Policy Type',
        ];

        $updatedData = [
            'policy_type_name' => 'Updated Policy Type',
        ];

        $policyType = PolicyType::create($policyTypeData);

        // Act
        $policyType->update($updatedData);

        // Assert
        $this->assertEquals($updatedData['policy_type_name'], $policyType->fresh()->policy_type_name);
    }

    /** @test */
    public function it_can_delete_a_policy_type()
    {
        // Arrange
        $policyTypeData = [
            'policy_type_name' => 'Test Policy Type',
        ];

        $policyType = PolicyType::create($policyTypeData);

        // Act
        $policyType->delete();

        // Assert
        $this->assertDatabaseMissing('policy_types', $policyTypeData);
    }
}
