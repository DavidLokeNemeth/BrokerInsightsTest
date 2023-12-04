<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_company()
    {
        // Arrange
        $companyData = [
            'company_name' => 'Test company',
        ];

        // Act
        $company = Company::create($companyData);

        // Assert
        $this->assertInstanceOf(Company::class, $company);
        $this->assertDatabaseHas('companies', $companyData);
    }

    /** @test */
    public function it_can_update_a_company()
    {
        // Arrange
        $originalData = [
            'company_name' => 'Original company',
        ];

        $updatedData = [
            'company_name' => 'Updated company',
        ];

        $company = Company::create($originalData);

        // Act
        $company->update($updatedData);

        // Assert
        $this->assertEquals($updatedData['company_name'], $company->fresh()->company_name);
        $this->assertDatabaseHas('companies', $updatedData);
    }

    /** @test */
    public function it_can_delete_a_company()
    {
        // Arrange
        $companyData = [
            'company_name' => 'company to be deleted',
        ];

        $company = Company::create($companyData);

        // Act
        $company->delete();

        // Assert
        $this->assertDatabaseMissing('companies', $companyData);
    }
}
