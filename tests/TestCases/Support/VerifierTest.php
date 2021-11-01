<?php

namespace Tests\TestCases\Support;

use Moves\Eloquent\Verifiable\Exceptions\VerificationException;
use Moves\Eloquent\Verifiable\Exceptions\VerificationRuleException;
use Moves\Eloquent\Verifiable\Support\Verifier;
use Tests\Rules\TestRule;
use Tests\Rules\TestVerifiable;
use Tests\TestCases\TestCase;

class VerifierTest extends TestCase
{
    public function testPassesAllRulesPassReturnsTrue()
    {
        $verifier = Verifier::build([
            new TestRule(true),
            new TestRule(true),
            new TestRule(true)
        ]);

        $this->assertTrue($verifier->passes(new TestVerifiable()));
    }

    public function testPassesAnyRuleFailsReturnsFalse()
    {
        $verifier = Verifier::build([
            new TestRule(true),
            new TestRule(true),
            new TestRule(false)
        ]);

        $this->assertFalse($verifier->passes(new TestVerifiable()));
    }

    public function testVerifyAllRulesPassReturnsTrue()
    {
        $verifier = Verifier::build([
            new TestRule(true),
            new TestRule(true),
            new TestRule(true)
        ]);

        $this->assertTrue($verifier->verify(new TestVerifiable()));
    }
    public function testVerifyAnyRuleFailsThrowsException()
    {
        $verifier = Verifier::build([
            new TestRule(true),
            new TestRule(true),
            new TestRule(false)
        ]);

        $this->expectException(VerificationException::class);

        $verifier->verify(new TestVerifiable());
    }

    public function testGetExceptionsReturnsAllRuleExceptions()
    {
        $verifier = Verifier::build([
            new TestRule(true),
            new TestRule(false),
            new TestRule(false)
        ]);

        $this->assertFalse($verifier->passes(new TestVerifiable()));

        $exceptions = $verifier->getExceptions();

        $this->assertCount(2, $exceptions);

        foreach ($exceptions as $exception) {
            $this->assertInstanceOf(VerificationRuleException::class, $exception);
        }
    }

    public function testGetMessagesReturnsExceptionMessages()
    {
        $verifier = Verifier::build([
            new TestRule(true),
            new TestRule(false),
            new TestRule(false)
        ]);

        $this->assertFalse($verifier->passes(new TestVerifiable()));

        $messages = $verifier->getMessages();
        $exceptions = $verifier->getExceptions();

        $this->assertSameSize($exceptions, $messages);
        $this->assertCount(2, $messages);

        foreach ($messages as $i => $message) {
            $this->assertEquals($exceptions[$i]->getMessage(), $message);
        }
    }

    public function testExceptionGetVerifierReturnsSameAsSource()
    {
        $verifier = new Verifier([
            new TestRule(true),
            new TestRule(false),
        ]);

        try {
            $verifier->verify(new TestVerifiable());

            $this->assertTrue(false);
        } catch (VerificationException $exception) {
            $this->assertEquals($verifier, $exception->getVerifier());
        }
    }

    public function testExceptionGetRuleReturnsCorrectRuleInstance()
    {
        $rule = new TestRule(false);

        $verifier = new Verifier([$rule]);

        $this->assertFalse($verifier->passes(new TestVerifiable()));

        $exceptions = $verifier->getExceptions();

        $this->assertCount(1, $exceptions);

        $exception = $exceptions[0];

        $this->assertInstanceOf(VerificationRuleException::class, $exception);

        $this->assertEquals($rule, $exception->getRule());
    }
}
