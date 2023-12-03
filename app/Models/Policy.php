<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'original_policy_ref', //Root Policy Ref
    ];
}
