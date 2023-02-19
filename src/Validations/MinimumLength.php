<?php

namespace Gandalf\Validations;

class MinimumLength extends ValidationRule
{
    private int $minSize;

    public function __construct(int $minSize)
    {
        $this->minSize = $minSize;
    }

    public function validate($subject): bool
    {
        return !(strlen($subject ?? '') < $this->minSize);
    }
}