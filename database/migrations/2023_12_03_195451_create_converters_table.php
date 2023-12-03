<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('converters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('broker_id');
            $table->foreign('broker_id')->references('id')->on('brokers')->onDelete('cascade');
            $table->string('key_name');
            $table->string('broker_call');
            $table->timestamps();
        });

        DB::table('converters')->insert(
            array(
                [
                    'broker_id' => 1,
                    'key_name' => 'policy_ref',
                    'broker_call' => 'PolicyNumber',
                ],
                [
                    'broker_id' => 2,
                    'key_name' => 'policy_ref',
                    'broker_call' => 'PolicyRef',
                ],
                [
                    'broker_id' => 1,
                    'key_name' => 'coverage_amount',
                    'broker_call' => 'InsuredAmount',
                ],
                [
                    'broker_id' => 2,
                    'key_name' => 'coverage_amount',
                    'broker_call' => 'CoverageAmount',
                ],
                [
                    'broker_id' => 1,
                    'key_name' => 'start_date',
                    'broker_call' => 'StartDate',
                ],
                [
                    'broker_id' => 2,
                    'key_name' => 'start_date',
                    'broker_call' => 'InitiationDate',
                ],
                [
                    'broker_id' => 1,
                    'key_name' => 'end_date',
                    'broker_call' => 'EndDate',
                ],
                [
                    'broker_id' => 2,
                    'key_name' => 'end_date',
                    'broker_call' => 'ExpirationDate',
                ],
                [
                    'broker_id' => 1,
                    'key_name' => 'activation_date',
                    'broker_call' => 'EffectiveDate',
                ],
                [
                    'broker_id' => 2,
                    'key_name' => 'activation_date',
                    'broker_call' => 'ActivationDate',
                ],
                [
                    'broker_id' => 1,
                    'key_name' => 'renewal_date',
                    'broker_call' => 'RenewalDate',
                ],
                [
                    'broker_id' => 2,
                    'key_name' => 'renewal_date',
                    'broker_call' => 'NextRenewalDate',
                ],
                [
                    'broker_id' => 1,
                    'key_name' => 'policy_cost',
                    'broker_call' => 'Premium',
                ],
                [
                    'broker_id' => 2,
                    'key_name' => 'policy_cost',
                    'broker_call' => 'CoverageCost',
                ],
                [
                    'broker_id' => 1,
                    'key_name' => 'policy_fee',
                    'broker_call' => 'PolicyFee',
                ],
                [
                    'broker_id' => 2,
                    'key_name' => 'policy_fee',
                    'broker_call' => 'ContractFee',
                ],
                [
                    'broker_id' => 1,
                    'key_name' => 'admin_fee',
                    'broker_call' => 'AdminFee',
                ],
                [
                    'broker_id' => 2,
                    'key_name' => 'admin_fee',
                    'broker_call' => 'AdminCharges',
                ],
                [
                    'broker_id' => 1,
                    'key_name' => 'commission',
                    'broker_call' => 'Commission',
                ],
                [
                    'broker_id' => 2,
                    'key_name' => 'commission',
                    'broker_call' => 'BrokerFee',
                ],
                [
                    'broker_id' => 1,
                    'key_name' => 'tax_fee',
                    'broker_call' => 'IPTAmount',
                ],
                [
                    'broker_id' => 2,
                    'key_name' => 'tax_fee',
                    'broker_call' => 'TaxAmount',
                ],
                [
                    'broker_id' => 1,
                    'key_name' => 'company_id',
                    'broker_call' => 'BusinessDescription',
                ],
                [
                    'broker_id' => 2,
                    'key_name' => 'company_id',
                    'broker_call' => 'CompanyDescription',
                ],
                [
                    'broker_id' => 1,
                    'key_name' => 'client_ref',
                    'broker_call' => 'ClientRef',
                ],
                [
                    'broker_id' => 2,
                    'key_name' => 'client_ref',
                    'broker_call' => 'ConsumerID',
                ],
                [
                    'broker_id' => 1,
                    'key_name' => 'client_type_id',
                    'broker_call' => 'ClientType',
                ],
                [
                    'broker_id' => 2,
                    'key_name' => 'client_type_id',
                    'broker_call' => 'ConsumerCategory',
                ],
                [
                    'broker_id' => 1,
                    'key_name' => 'contact_type_id',
                    'broker_call' => 'BusinessEvent',
                ],
                [
                    'broker_id' => 2,
                    'key_name' => 'contact_type_id',
                    'broker_call' => 'ContractEvent',
                ],
                [
                    'broker_id' => 1,
                    'key_name' => 'policy_type_id',
                    'broker_call' => 'PolicyType',
                ],
                [
                    'broker_id' => 2,
                    'key_name' => 'policy_type_id',
                    'broker_call' => 'ContractCategory',
                ],
                [
                    'broker_id' => 1,
                    'key_name' => 'insurer_id',
                    'broker_call' => 'Insurer',
                ],
                [
                    'broker_id' => 2,
                    'key_name' => 'insurer_id',
                    'broker_call' => 'Underwriter',
                ],
                [
                    'broker_id' => 1,
                    'key_name' => 'insurance_id',
                    'broker_call' => 'Product',
                ],
                [
                    'broker_id' => 2,
                    'key_name' => 'insurance_id',
                    'broker_call' => 'InsurancePlan',
                ],
                [
                    'broker_id' => 1,
                    'key_name' => 'insurance_ref',
                    'broker_call' => 'InsurerPolicyNumber',
                ],
                [
                    'broker_id' => 2,
                    'key_name' => 'insurance_ref',
                    'broker_call' => 'InsuranceCompanyRef',
                ],
                [
                    'broker_id' => 1,
                    'key_name' => 'original_policy_ref',
                    'broker_call' => 'RootPolicyRef',
                ],
                [
                    'broker_id' => 2,
                    'key_name' => 'original_policy_ref',
                    'broker_call' => 'PrimaryPolicyRef',
                ],
            )
        );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('converters');
    }
};
