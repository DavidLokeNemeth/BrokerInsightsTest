<?php

namespace App\Console\Commands;

use App\Models\Broker;
use App\Models\ClientType;
use App\Models\Company;
use App\Models\ContactType;
use App\Models\Converter;
use App\Models\Insurance;
use App\Models\Insurer;
use App\Models\Policy;
use App\Models\PolicyType;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class BrokerImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'broker:import {filePath} {brokerName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import broker policies from a CSV file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Get the file path from the command line
        $filePath = $this->argument('filePath');

        //Check the file is existing or not
        if (!Storage::exists($filePath)) {
            $this->error('The specified file does not exist.');
            return Command::FAILURE;
        }

        //Get the broker name from the command line
        $brokerName = $this->argument('brokerName');
        $broker = Broker::firstOrCreate(
            ['broker_name' => $brokerName]
        );

        //open the file or give error if we can't
        $file = fopen(storage_path('app/' . $filePath), 'r');
        if ($file !== false) {
            //Get first line for the header
            $headers = fgetcsv($file);

            //Going through all line and link to the header as key
            while (($row = fgetcsv($file)) !== false) {
                //Create new policy model for the line
                $policy = new Policy();

                //Set broker
                $policy->broker_id = $broker->id;

                //Clear out insurer and insurance from previously
                $insurer = null;
                $insuranceName = null;

                //check every column
                foreach ($row as $key => $value) {

                    //looking for the column name and our key name conversion
                    $header = Converter::where('broker_id', $broker->id)->where('broker_call', $headers[$key])->first();

                    //If have noting in the system then ask and setup
                    if(!$header){
                        $headerList = Config::get('keyconversions');
                        $allKeys = array_keys($headerList);
                        $exists = Converter::where('broker_id', $broker->id)->get();
                        $existsList =array_column((array)$exists, 'key_name');
                        $difference = array_diff($allKeys, $existsList);

                        $question = 'We not have this header in out system, which describe '.$headers[$key].'?';

                        //This is writing out all key option. if we want this give client need a better conversion and a displayable description.
                        $option = $this->choice($question, $difference);

                        $header = new Converter();
                        $header->broker_id = $broker->id;
                        $header->broker_call = $headers[$key];
                        $header->key_name = $option;
                        $header->save();
                    }

                    //Grab the policy column name
                    $policyKey = $header->key_name;
                    switch ($policyKey) {
                        case 'start_date':
                        case 'end_date':
                        case 'activation_date':
                        case 'renewal_date':
                            //strtotime read as UK date only if we use - not /
                            $policy->$policyKey = date('Y-m-d', strtotime(str_replace('/', '-', $value)));
                            break;
                        case 'company_id':
                            $company = Company::firstOrCreate(
                                ['company_name' => $value]
                            );
                            $policy->company_id = $company->id;
                            break;
                        case 'client_type_id':
                            $clientType = ClientType::where('client_type_name', $value)->first();
                            $policy->client_type_id = $clientType->id;
                            break;
                        case 'contact_type_id':
                            if(str_contains(strtolower($value), 'renew')){
                                $policy->contact_type_id = 2;
                            }elseif(str_contains(strtolower($value), 'new') || str_contains(strtolower($value), 'initiation')){
                                $policy->contact_type_id = 1;
                            }else{
                                $policy->contact_type_id = 3;
                            }
                            break;
                        case 'policy_type_id':
                            $policyType = PolicyType::firstOrCreate(
                                ['policy_type_name' => $value]
                            );
                            $policy->policy_type_id = $policyType->id;
                            break;
                        case 'insurer_id':
                        case 'insurance_id':
                            if($policyKey == 'insurer_id'){
                                $insurer = Insurer::firstOrCreate(
                                    ['insurer_name' => $value]
                                );
                                $policy->insurer_id = $insurer->id;
                            }elseif($policyKey == 'insurance_id'){
                                $insuranceName = $value;
                            }

                            //Since we not know the insurer or the insurance name come up earlier I came up with this solution.
                            if($insurer && $insuranceName){
                                $insurance = Insurance::firstOrCreate(
                                    ['insurer_id' => $insurer->id],
                                    ['insurance_name' => $insuranceName]
                                );
                                $policy->insurance_id = $insurance->id;
                            }
                            break;
                        case 'coverage_amount':
                        case 'policy_cost':
                        case 'policy_fee':
                        case 'admin_fee':
                        case 'commission':
                        case 'tax_fee':
                            //If price is like TBC or other comment, we set to 0
                            if(!is_numeric($value)) $value = 0;
                        default:
                            $policy->$policyKey = $value;
                            break;
                    }
                }
                $policy->save();
            }
            fclose($file);
        } else {
            $this->error('Unable to open the file.');
            return Command::FAILURE;
        }

        $this->info('Successfully imported all data');
        return Command::SUCCESS;
    }
}
