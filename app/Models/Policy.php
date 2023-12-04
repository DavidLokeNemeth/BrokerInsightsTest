<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Policy extends Model
{
    use HasFactory;

    protected $fillable = [
        'broker_id',
        'policy_ref', //Policy Number
        'coverage_amount', //InsuredAmount
        'start_date', //Start Date
        'end_date', //End Date
        'activation_date', //Effective Date
        'renewal_date', //Renewal Date
        'policy_cost', //Premium
        'policy_fee', //Policy Fee
        'admin_fee', //Admin Fee
        'commission', //Commission
        'tax_fee', //IPTAmount
        'company_id', //Business Description
        'client_ref', //Client Red
        'client_type_id', //Client Type
        'contact_type_id', //Business Event
        'policy_type_id', //Policy Type
        'insurer_id', //Insurer
        'insurance_id', //Product
        'insurance_ref', //InsurerPolicyNumber
        'original_policy_ref', //Root Policy Ref
    ];

    /**
     * Validation rules
     *
     * @var string[]
     */
    public static $rules = [
        'broker_id' => 'required|integer',
        'policy_ref' => 'required|string',
        'coverage_amount' => 'required|integer',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'activation_date' => 'required|date',
        'renewal_date' => 'required|date',
        'policy_cost' => 'required|float',
        'policy_fee' => 'required|float',
        'admin_fee' => 'required|float',
        'commission' => 'required|float',
        'tax_fee' => 'required|float',
        'company_id' => 'required|integer',
        'client_ref' => 'required|string',
        'client_type_id' => 'required|integer',
        'contact_type_id' => 'required|integer',
        'policy_type_id' => 'required|integer',
        'insurer_id' => 'required|integer',
        'insurance_id' => 'required|integer',
        'insurance_ref' => 'required|string',
        'original_policy_ref' => 'required|string',
    ];

    public function totalPolicy(?Broker $broker=null):?int
    {
        if($broker) return $this::where('broker_id', $broker->id)->count();

        return $this->count();
    }

    public function totalCustomer(?Broker $broker=null):?int
    {
        $query =  $this::distinct();
        if($broker) $query-> where('broker_id', $broker->id);

        return $query->count('client_ref');
    }

    public function totalAmount(?Broker $broker=null):?int
    {
        if($broker) return $this::where('broker_id', $broker->id)->sum('coverage_amount');

        return $this->sum('coverage_amount');
    }

    public function averageDayLength(?Broker $broker=null):?float
    {
        if($broker) return $this::where('broker_id', $broker->id)->avg(DB::raw('DATEDIFF(end_date, start_date)'));

        return $this->avg(DB::raw('DATEDIFF(end_date, start_date)'));
    }

    public function activePolicies(?Broker $broker=null):?int
    {
        $sql = 'select count(*) as aggregate from `policies` where CURRENT_DATE between start_date and end_date';
        if($broker) $sql .=' AND broker_id = '.$broker->id;

        $res = DB::select(DB::raw($sql));

        return $res[0]->aggregate;

        //This should be a much nicer solution, but some reason didn't want to accept CURRENT_DATE and always return 0
//        $query =  $this::whereBetween(DB::raw('CURRENT_DATE'), ['start_date', 'end_date']);
//        if($broker) $query-> where('broker_id', $broker->id);
//        return $this->count();

    }
}
