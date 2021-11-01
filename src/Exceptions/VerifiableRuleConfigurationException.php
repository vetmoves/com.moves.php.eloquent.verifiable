<?php

namespace Moves\Eloquent\Verifiable\Exceptions;

use Moves\Eloquent\Verifiable\Contracts\IRule;

class VerifiableRuleConfigurationException extends \DomainException
{
    /** @var IRule $rule */
    protected $rule;

    public function __construct($message, IRule $rule)
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
