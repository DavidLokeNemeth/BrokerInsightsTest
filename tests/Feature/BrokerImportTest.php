<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrokerImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_importing_without_a_file()
    {
        $this->artisan('broker:import notgood.csv "Broker 1"')
            ->expectsOutput('The specified file does not exist.')
            ->assertFailed();
    }

    public function test_import_brokers_policy_command()
    {
        $this->artisan('broker:import broker1.csv "Broker No1"')
            ->expectsOutputToContain('Successfully imported all data')
            ->assertSuccessful();
    }

    public function test_import_second_brokers_policy_command()
    {
        $this->artisan('broker:import broker2.csv "Broker No2"')
            ->expectsOutputToContain('Successfully imported all data')
            ->assertSuccessful();
    }
}
