<?php

namespace Moves\Eloquent\Verifiable\Contracts;

interface IRule
{
    public function verify(IVerifiable $verifiable): bool;
}