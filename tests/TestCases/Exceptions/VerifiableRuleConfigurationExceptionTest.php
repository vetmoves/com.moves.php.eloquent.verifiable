<?php

namespace Tests\TestCases\Exceptions;

use Moves\Eloquent\Verifiable\Exceptions\VerifiableRuleConfigurationException;
use Tests\Rules\TestRule;
use Tests\TestCases\TestCase;

class VerifiableRuleConfigurationExceptionTest extends TestCase
{
    public function testGetRule()
    {
        $rule = new TestRule(false);

        $exception = new VerifiableRuleConfigurationException('', $rule);

        $this->assertSame($rule, $exception->getRule());
    }
}
