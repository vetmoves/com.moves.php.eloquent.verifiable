<?php

namespace Tests\TestCases\Exceptions;

use Moves\Eloquent\Verifiable\Exceptions\VerificationException;
use Moves\Eloquent\Verifiable\Support\Verifier;
use Tests\Rules\TestRule;
use Tests\TestCases\TestCase;

class VerificationExceptionTest extends TestCase
{
    public function testGetVerifier()
    {
        $verifier = new Verifier([
            new TestRule(true),
            new TestRule(false),
        ]);

        $exception = new VerificationException($verifier);

        $this->assertSame($verifier, $exception->getVerifier());
    }
}
