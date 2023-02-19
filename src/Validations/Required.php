<?php

namespace Gandalf\Validations;

class Required extends ValidationRule
{
    public function validate($subject): bool
    {
        return !is_null($subject);
    }
}