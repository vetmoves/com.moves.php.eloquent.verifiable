<?php

namespace Tests\TestCases\Exceptions;

use Moves\Eloquent\Verifiable\Exceptions\VerificationRuleException;
use Tests\Rules\TestRule;
use Tests\TestCases\TestCase;

class VerificationRuleExceptionTest extends TestCase
{
    public function testGetRule()
    {
        $rule = new TestRule(false);

        $exception = new VerificationRuleException('', $rule);

        $this->assertSame($rule, $exception->getRule());
    }
}
