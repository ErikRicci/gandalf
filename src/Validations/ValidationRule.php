<?php

namespace Gandalf\Validations;

abstract class ValidationRule
{
    public abstract function validate($subject): bool;
}