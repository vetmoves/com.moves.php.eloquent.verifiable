<?php

namespace Tests\Rules;

use Moves\Eloquent\Verifiable\Contracts\IRule;
use Moves\Eloquent\Verifiable\Contracts\IVerifiable;
use Moves\Eloquent\Verifiable\Exceptions\VerificationRuleException;

class TestRule implements IRule
{
    /** @var bool $passes */
    protected $passes;

    public function __construct(bool $passes)
    {
        $this->passes = $passes;
    }

    public function verify(IVerifiable $verifiable): bool
    {
        if (!$this->passes)
        {
            throw new VerificationRuleException('Rule does not pass', $this);
        }

        return true;
    }
}
