<?php

namespace Gandalf;

use Gandalf\Validations\ValidationRule;

class RulesPipe
{
    private bool $passed = true;

    public function __construct(mixed $subject, ValidationRule ...$rules)
    {
        foreach ($rules as $rule) {
            if (! $rule->validate($subject)) {
                $this->passed = false;
            }
        }
    }

    public function passed(): bool
    {
        return $this->passed;
    }
}