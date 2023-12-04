<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Converter extends Model
{
    use HasFactory;

    protected $fillable = [
        'broker_id',
        'key_name',
        'broker_call',
    ];

    /**
     * Validation rules
     *
     * @var string[]
     */
    public static $rules = [
        'broker_id' => 'required|integer',
        'key_name' => 'required|string',
        'broker_call' => 'required|string',
    ];
}
