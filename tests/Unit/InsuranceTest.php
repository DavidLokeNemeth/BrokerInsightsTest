<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Insurer;
use App\Models\Insurance;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InsuranceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_insurer()
    {
        // Arrange
        $insurerData = [
            'insurer_name' => 'Test Insurer',
        ];

        // Act
        $insurer = Insurer::create($insurerData);

        // Assert
        $this->assertInstanceOf(Insurer::class, $insurer);
        $this->assertDatabaseHas('insurers', $insurerData);
    }

    /** @test */
    public function it_can_update_an_insurer()
    {
        // Arrange
        $insurerData = [
            'insurer_name' => 'Test Insurer',
        ];

        $updatedData = [
            'insurer_name' => 'Updated Insurer',
        ];

        $insurer = Insurer::create($insurerData);

        // Act
        $insurer->update($updatedData);

        // Assert
        $this->assertEquals($updatedData['insurer_name'], $insurer->fresh()->insurer_name);
    }

    /** @test */
    public function it_can_delete_an_insurer()
    {
        // Arrange
        $insurerData = [
            'insurer_name' => 'Test Insurer',
        ];

        $insurer = Insurer::create($insurerData);

        // Act
        $insurer->delete();

        // Assert
        $this->assertDatabaseMissing('insurers', $insurerData);
    }

    /** @test */
    public function it_can_create_an_insurance()
    {
        // Arrange
        $insurerData = [
            'insurer_name' => 'Test Insurer',
        ];
        $insurer = Insurer::create($insurerData);

        $insuranceData = [
            'insurer_id' => $insurer->id,
            'insurance_name' => 'Test Insurance',
        ];

        // Act
        $insurance = Insurance::create($insuranceData);

        // Assert
        $this->assertInstanceOf(Insurance::class, $insurance);
        $this->assertDatabaseHas('insurances', $insuranceData);
    }

    /** @test */
    public function it_can_update_an_insurance()
    {
        // Arrange
        $insurer1Data = [
            'insurer_name' => 'Test Insurer 1',
        ];
        $insurer = Insurer::create($insurer1Data);

        $insurer2Data = [
            'insurer_name' => 'Test Insurer 2',
        ];
        $insurer2 = Insurer::create($insurer2Data);

        $insuranceData = [
            'insurer_id' => $insurer->id,
            'insurance_name' => 'Test Insurance',
        ];

        $updatedData = [
            'insurer_id' => $insurer2->id,
            'insurance_name' => 'Updated Insurance',
        ];

        $insurance = Insurance::create($insuranceData);

        // Act
        $insurance->update($updatedData);

        // Assert
        $this->assertEquals($updatedData['insurer_id'], $insurance->fresh()->insurer_id);
        $this->assertEquals($updatedData['insurance_name'], $insurance->fresh()->insurance_name);
    }

    /** @test */
    public function it_can_delete_an_insurance()
    {
        // Arrange
        $insurer1Data = [
            'insurer_name' => 'Test Insurer 1',
        ];
        $insurer = Insurer::create($insurer1Data);

        $insuranceData = [
            'insurer_id' => $insurer->id,
            'insurance_name' => 'Test Insurance',
        ];

        $insurance = Insurance::create($insuranceData);

        // Act
        $insurance->delete();

        // Assert
        $this->assertDatabaseMissing('insurances', $insuranceData);
    }
}
