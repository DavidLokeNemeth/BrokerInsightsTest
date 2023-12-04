<?php

namespace Tests\Unit;

use App\Models\Broker;
use App\Models\Company;
use App\Models\Insurance;
use App\Models\Insurer;
use App\Models\Policy;
use App\Models\PolicyType;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_policy()
    {
        // Arrange
        $brokerData = [
            'broker_name' => 'Test Broker',
        ];
        $broker = Broker::create($brokerData);

        $companyData = [
            'company_name' => 'Test company',
        ];
        $company = Company::create($companyData);

        $policyTypeData = [
            'policy_type_name' => 'Test Policy Type',
        ];
        $policyType = PolicyType::create($policyTypeData);

        $insurerData = [
            'insurer_name' => 'Test Insurer',
        ];
        $insurer = Insurer::create($insurerData);

        $insuranceData = [
            'insurer_id' => $insurer->id,
            'insurance_name' => 'Test Insurance',
        ];
        $insurance = Insurance::create($insuranceData);

        $policyData = [
            'broker_id' => $broker->id,
            'policy_ref' => 'Test Policy Reference',
            'coverage_amount' => 900000,
            'start_date' => '2021-12-12',
            'end_date' => '2025-12-12',
            'activation_date' => '2021-12-12',
            'renewal_date' => '2025-12-12',
            'policy_cost' => 600,
            'policy_fee' => 20,
            'admin_fee' => 20,
            'commission' => 0.13,
            'tax_fee' => 20,
            'company_id' => $company->id,
            'client_ref' => 'Test Client Reference',
            'client_type_id' => 1,
            'contact_type_id' => 1,
            'policy_type_id' => $policyType->id,
            'insurer_id' => $insurer->id,
            'insurance_id' => $insurance->id,
            'insurance_ref' => 'Test Insurance Reference',
            'original_policy_ref' => 'Test original Reference',
        ];

        // Act
        $policy = Policy::create($policyData);

        // Assert
        $this->assertInstanceOf(Policy::class, $policy);
        $this->assertDatabaseHas('policy', $policyData);
    }
}
