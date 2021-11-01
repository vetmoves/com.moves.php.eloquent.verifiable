<?php

namespace Moves\Eloquent\Verifiable\Exceptions;

use Exception;
use Moves\Eloquent\Verifiable\Support\Verifier;

class VerificationException extends Exception
{
    /** @var Verifier $verifier */
    protected $verifier;

    public function __construct(Verifier $verifier)
    {
        parent::__construct();

        $this->verifier = $verifier;
    }

    public function getVerifier(): Verifier
    {
        return $this->verifier;
    }
}
