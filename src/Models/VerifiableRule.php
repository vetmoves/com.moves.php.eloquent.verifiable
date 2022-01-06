<?php

namespace Moves\Eloquent\Verifiable\Models;

use Illuminate\Database\Eloquent\Model;
use Moves\Eloquent\Subtypeable\Contracts\ISubtypeable;
use Moves\Eloquent\Subtypeable\Traits\TSubtypeable;
use Moves\Eloquent\Verifiable\Contracts\IRule;

abstract class VerifiableRule extends Model implements IRule, ISubtypeable
{
    use TSubtypeable;

    protected $casts = [
        'config' => 'array'
    ];

    protected $fillable = [
        'config'
    ];
}
