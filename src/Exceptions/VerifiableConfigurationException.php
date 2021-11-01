<?php

namespace Moves\Eloquent\Verifiable\Exceptions;

use Moves\Eloquent\Verifiable\Contracts\IVerifiable;

class VerifiableConfigurationException extends \DomainException
{
    /** @var IVerifiable $verifiable */
    protected $verifiable;

    public function __construct($message, IVerifiable $verifiable)
    {
        parent::__construct($message);

        $this->verifiable = $verifiable;
    }

    /**
     * @return IVerifiable
     */
    public function getVerifiable(): IVerifiable
    {
        return $this->verifiable;
    }
}
