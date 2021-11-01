<?php

namespace Moves\Eloquent\Verifiable\Support;

use Moves\Eloquent\Verifiable\Contracts\IRule;
use Moves\Eloquent\Verifiable\Contracts\IVerifiable;
use Moves\Eloquent\Verifiable\Exceptions\VerificationException;
use Moves\Eloquent\Verifiable\Exceptions\VerificationRuleException;

class Verifier
{
    /** @var IRule[] $rules */
    protected $rules;

    /** @var VerificationRuleException[] $exceptions */
    protected $exceptions = [];

    /**
     * Verifier constructor.
     * @param IRule[] $rules
     */
    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * Verifier builder.
     * @param IRule[] $rules
     * @return Verifier
     */
    public static function build(array $rules): Verifier
    {
        return new static($rules);
    }

    public function passes(IVerifiable $verifiable): bool
    {
        $this->exceptions = [];

        foreach ($this->rules as $rule)
        {
            try {
                $rule->verify($verifiable);
            } catch (VerificationRuleException $e) {
                $this->exceptions[] = $e;
            }
        }

        return count($this->exceptions) == 0;
    }

    /**
     * @param IVerifiable $verifiable
     * @return bool
     * @throws VerificationException
     */
    public function verify(IVerifiable $verifiable): bool
    {
        if (!$this->passes($verifiable))
        {
            throw new VerificationException($this);
        }

        return true;
    }

    /**
     * @return VerificationRuleException[]
     */
    public function getExceptions(): array
    {
        return $this->exceptions;
    }

    /**
     * @return string[]
     */
    public function getMessages(): array
    {
        return array_map(function ($exception) {
            return $exception->getMessage();
        }, $this->exceptions);
    }
}
