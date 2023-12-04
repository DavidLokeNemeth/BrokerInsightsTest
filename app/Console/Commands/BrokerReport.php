<?php

namespace App\Console\Commands;

use App\Models\Broker;
use App\Models\Policy;
use Illuminate\Console\Command;

class BrokerReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'broker:report {brokerName?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        //Get the broker name from the command line
        $brokerName = $this->argument('brokerName');
        if($brokerName) {
            $broker = Broker::firstOrCreate(
                ['broker_name' => $brokerName]
            );
            $this->info("Summary for $brokerName");
        }else{
            $broker = null;
            $this->info("Summary for all broker");
        }

        $policy = new Policy();

        $totalPolicy = $policy->totalPolicy($broker);
        $this->info("Total count of policies: $totalPolicy");
        $totalCustomer = $policy->totalCustomer($broker);
        $this->info("Count of customers: $totalCustomer");
        $totalAmount = $policy->totalAmount($broker);
        $this->info("Sum of insured amount: $totalAmount");
        $averageDays = $policy->averageDayLength($broker);
        $this->info("Average policy duration (days): $averageDays");
        $activePolicy = $policy->activePolicies($broker);
        $this->info("Active policies: $activePolicy");

        return Command::SUCCESS;
    }
}
