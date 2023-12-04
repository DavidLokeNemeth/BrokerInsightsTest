<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrokerReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_report_without_data()
    {
        $this->artisan('broker:report')
            ->expectsOutputToContain('Summary for all broker')
            ->expectsOutputToContain('Total count of policies:')
            ->assertSuccessful();
    }

    public function test_report_all_broker_policy_command()
    {
        $this->artisan('broker:import broker1.csv "Broker No1"');
        $this->artisan('broker:import broker2.csv "Broker No2"');
        $this->artisan('broker:report')
            ->expectsOutputToContain('Summary for all broker')
            ->expectsOutputToContain('Total count of policies: 61')
            ->expectsOutputToContain('Count of customers: 52')
            ->expectsOutputToContain('Sum of insured amount: 46637000')
            ->expectsOutputToContain('Average policy duration (days): 683.3115')
            ->expectsOutputToContain('Active policies: 19')
            ->assertSuccessful();
    }

    public function test_import_second_brokers_policy_command()
    {
        $this->artisan('broker:import broker1.csv "Broker No1"');
        $this->artisan('broker:import broker2.csv "Broker No2"');
        $this->artisan('broker:report "Broker No2"')
            ->expectsOutputToContain('Summary for Broker No2')
            ->expectsOutputToContain('Total count of policies: 21')
            ->expectsOutputToContain('Count of customers: 15')
            ->expectsOutputToContain('Sum of insured amount: 15727000')
            ->expectsOutputToContain('Average policy duration (days): 365.381')
            ->expectsOutputToContain('Active policies: 7')
            ->assertSuccessful();
    }
}
