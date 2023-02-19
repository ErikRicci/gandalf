<?php

namespace Gandalf;

use Gandalf\Exceptions\InvalidSubjectException;
use Gandalf\Validations\ValidationRule;

class Validator
{
    private mixed $subject;
    private ValidationRule $rules;

    public function __construct(mixed $subject, ValidationRule $rules)
    {
        $this->subject = $subject;
        $this->rules = $rules;
    }

    public static function for(mixed $subject, ValidationRule $rules): Validator
    {
        return new self($subject, $rules);
    }

    public function validate(): bool
    {
        return (new RulesPipe($this->subject, ...$this->rules))->passed();
    }

    /** @throws InvalidSubjectException */
    public function validateOrCry(): void
    {
        if (! $this->validate()) {
            throw new InvalidSubjectException;
        }
    }
}