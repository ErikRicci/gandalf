<?php

namespace Gandalf\Enums;

use Gandalf\Validations\{
    MinimumLength,
    Required
};

enum ValidationRuleEnum: string
{
    case REQUIRED = Required::class;
    case MIN = MinimumLength::class;

    public static function fromName(string $name): ?string
    {
        foreach (self::cases() as $case) {
            if ($case->name == strtoupper($name)) {
                return $case->value;
            }
        }

        return null;
    }
}
