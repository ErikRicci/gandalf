<?php

namespace Gandalf;

use Gandalf\Validations\ValidationRule;

class Validator
{
    private array|object $subject;
    private ValidationRule $rules;

    public function __construct(array|object $subject, ValidationRule $rules)
    {
        $this->subject = $subject;
        $this->rules = $rules;
    }

    public static function for(array|object $subject, ValidationRule $rules): Validator
    {
        return new self($subject, $rules);
    }

    public function validate(): bool
    {
        return (new RulesPipe($this->subject, ...$this->rules))->passed();
    }
}