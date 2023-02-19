<?php

namespace Gandalf;

use Gandalf\Enums\ValidationRuleEnum;
use Gandalf\Exceptions\InvalidValidationRuleException;
use Gandalf\Validations\ValidationRule;

class ValidationRuleParser
{
    private const SEPARATOR = '|';
    private const ARGS_SEPARATOR = ':';

    /**
     * @return ValidationRule[]
     * @throws InvalidValidationRuleException
     */
    public static function from(string $rulesString): array
    {
        $ruleInstancesArray = [];
        $rulesArray = explode(self::SEPARATOR, $rulesString);
        foreach ($rulesArray as $rule) {
            $ruleAndArgs = explode(self::ARGS_SEPARATOR, $rule);
            @[$rule, $ruleArgs] = $ruleAndArgs;
            $ruleClass = ValidationRuleEnum::fromName($rule);
            if (! class_exists($ruleClass) || is_null($ruleClass)) {
                throw new InvalidValidationRuleException;
            }
            $ruleArgs = is_null($ruleArgs) ? [] : explode(',', $ruleArgs);
            /** @var ValidationRule $ruleInstance */
            $ruleInstancesArray[] = new $ruleClass(...$ruleArgs);
        }

        return $ruleInstancesArray;
    }
}