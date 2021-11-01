<?php

namespace Moves\Eloquent\Verifiable\Exceptions;

use Exception;
use Moves\Eloquent\Verifiable\Contracts\IRule;

class VerificationRuleException extends Exception
{
    /** @var IRule $rule */
    protected $rule;

    public function __construct(string $message, IRule $rule)
    {
        parent::__construct($message);

        $this->rule = $rule;
    }

    /**
     * @return IRule
     */
    public function getRule(): IRule
    {
        return $this->rule;
    }
}
