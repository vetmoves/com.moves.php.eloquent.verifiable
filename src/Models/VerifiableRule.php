<?php

namespace Moves\Eloquent\Verifiable\Models;

use Illuminate\Database\Eloquent\Model;
use Moves\Eloquent\Castable\Traits\TCastable;
use Moves\Eloquent\Verifiable\Contracts\IRule;

abstract class VerifiableRule extends Model implements IRule
{
    use TCastable;

    protected $casts = [
        'config' => 'array'
    ];

    protected $fillable = [
        'config'
    ];
}
