<?php

namespace Tests\TestCases\Exceptions;

use Moves\Eloquent\Verifiable\Exceptions\VerifiableConfigurationException;
use Tests\Rules\TestVerifiable;
use Tests\TestCases\TestCase;

class VerifiableConfigurationExceptionTest extends TestCase
{
    public function testGetVerifiable()
    {
        $verifiable = new TestVerifiable();

        $exception = new VerifiableConfigurationException('', $verifiable);

        $this->assertSame($verifiable, $exception->getVerifiable());
    }
}
