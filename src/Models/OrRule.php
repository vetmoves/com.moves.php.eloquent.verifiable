<?php

namespace Moves\Eloquent\Verifiable\Models;

use Moves\Eloquent\Verifiable\Contracts\IRule;
use Moves\Eloquent\Verifiable\Contracts\IVerifiable;
use Moves\Eloquent\Verifiable\Exceptions\VerificationRuleException;

class OrRule implements IRule
{
    /** @var IRule[] */
    protected $rules;

    /** @var string */
    protected $errorMessage;

    /**
     * @param IRule[] $rules
     * @param string|null $errorMessage
     */
    public function __construct(array $rules, string $errorMessage = null)
    {
        $this->rules = $rules;
        $this->errorMessage = $errorMessage;
    }

    /**
     * @param IVerifiable $verifiable
     * @return bool
     * @throws VerificationRuleException
     */
    public function verify(IVerifiable $verifiable): bool
    {
        $passes = false;
        $errors = collect();

        foreach ($this->rules as $rule)
        {
            try {
                $rule->verify($verifiable);
                return true;
            } catch (VerificationRuleException $e) {
                $errors->push($e);
            }
        }

        if (!$passes) {
            $errorMessage = $this->errorMessage;

            if (empty($errorMessage)) {
                $errorMessage = $errors->map(fn ($e) => $e->getMessage())
                    ->unique()
                    ->implode(PHP_EOL . 'OR' . PHP_EOL);
            }

            throw new VerificationRuleException($errorMessage, $this);
        }

        return $passes;
    }
}
