<?php

namespace Gandalf;

class ValidatorFacade
{
    public function validate(object|array $data, array $rules = []): bool
    {
        $rules = array_map(fn ($rulesString) => ValidationRuleParser::from($rulesString), $rules);
        foreach ($rules as $subject => $validationRules) {
            foreach ($validationRules as $validationRule) {
                $valid = $validationRule->validate($data[$subject]);
                if (! $valid) {
                    return false;
                }
            }
        }

        return true;
    }
}