<?php

class BusyBeeDynamicModel
{
    public const RULE_DEFAULT = 'rule_default';
    public const RULE_REQUIRED = 'rule_required';
    public const RULE_STRING = 'rule_string';
    public const RULE_LENGTH_MAX = 'rule_length_max';
    public const RULE_LENGTH_MIN = 'rule_length_min';
    public const RULE_DIGIT_MAX = 'rule_digit_max';
    public const RULE_DIGIT_MIN = 'rule_digit_min';
    public const RULE_MATCH = 'rule_match';
    public const RULE_EMAIL = 'rule_email';
    public const RULE_IN = 'rule_in';
    public const RULE_NUMERIC = 'rule_numeric';
    public const RULE_FILTER_ARRAY = 'rule_filter_array';

    protected array $attributes = [];
    protected array $errors = [];
    protected array $rules = [];
    protected array $errorMessages = [
        self::RULE_REQUIRED => 'Field is required.',
        self::RULE_STRING => 'Value must be a string.',
        self::RULE_LENGTH_MAX => 'The max length of field is {max}.',
        self::RULE_LENGTH_MIN => 'The min length of field is {min}.',
        self::RULE_DIGIT_MAX => 'The max value of field is {max}.',
        self::RULE_DIGIT_MIN => 'The min value of field is {min}.',
        self::RULE_MATCH => 'This field is not match to {match}.',
        self::RULE_EMAIL => 'This is not correct Email.',
        self::RULE_IN => 'Value out of range',
        self::RULE_NUMERIC => 'This is not numeric value.',
    ];

    protected function supportedAttributes(): array
    {
        $attributes = [];
        foreach ($this->rules as $rule) {
            foreach ((array) $rule[0] as $attribute) {
                $attributes[] = $attribute;
            }
        }
        return array_unique($attributes);
    }

    protected function filterAttributes(): void
    {
        foreach ($this->attributes as $attribute => $value) {
            if (!in_array($attribute, $this->supportedAttributes())) {
                unset($this->attributes[$attribute]);
            }
        }
    }

    protected function unknownProperty(string $name): void
    {
        throw new Error(
            sprintf(
                'Unknown property %s called in %s, line %d',
                $name,
                __CLASS__,
                __LINE__
            )
        );
    }

    public function rules(): array
    {
        return $this->rules;
    }

    /**
     * Method for setting validation rules.
     * Passed parameter $rules must be in format:
     * ```
     * $model->setRules(
     *     [
     *          ['my_custom_attr', BusyBeeDynamicModel::RULE_REQUIRED],
     *          [
     *              ['my_custom_attr_2', 'my_custom_attr_3'],
     *              BusyBeeDynamicModel::RULE_LENGTH_MAX,
     *              'max' => 3,
     *          ],
     *     ]
     * );
     * ```
     *
     * @param array $rules
     *
     * @return $this
     */
    public function setRules(array $rules): self
    {
        $this->rules = $rules;
        $this->filterAttributes();
        return $this;
    }

    /**
     * {@see setRules()}.
     * @param array $rule
     *
     * @return $this
     */
    public function addRule(array $rule): self
    {
        $this->rules[] = $rule;
        return $this;
    }

    public function validate(): bool
    {
        foreach ($this->rules() as $ruleData) {
            if (!isset($ruleData[1])) {
                continue;
            }

            $ruleName = $ruleData[1];
            foreach ((array) $ruleData[0] as $attribute) {
                $value = $this->getAttribute($attribute);
                $skip = (!isset($ruleData['skip_on_empty']) || $ruleData['skip_on_empty'] !== false)
                    && empty($value);

                if (self::RULE_DEFAULT === $ruleName && empty($value)) {
                    $this->{$attribute} = $ruleData['value'];
                }
                if (
                    self::RULE_REQUIRED === $ruleName
                    && empty($value)
                    && (
                        !isset($ruleData['when'])
                        || call_user_func($ruleData['when']) === true
                    )
                ) {
                    $this->addError($attribute, $ruleName);
                }
                if (self::RULE_STRING === $ruleName && !is_string($value)) {
                    $this->addError($attribute, $ruleName);
                }
                if (self::RULE_LENGTH_MAX === $ruleName && !$skip && mb_strlen($value) > $ruleData['max']) {
                    $this->addError($attribute, $ruleName, $ruleData);
                }
                if (self::RULE_LENGTH_MIN === $ruleName && !$skip && mb_strlen($value) < $ruleData['min']) {
                    $this->addError($attribute, $ruleName, $ruleData);
                }
                if (self::RULE_DIGIT_MAX === $ruleName && !$skip && $value > $ruleData['max']) {
                    $this->addError($attribute, $ruleName, $ruleData);
                }
                if (
                    self::RULE_DIGIT_MIN === $ruleName
                    && !$skip
                    && $value < $ruleData['min']
                    && (
                        !isset($ruleData['when'])
                        || call_user_func($ruleData['when']) === true
                    )
                ) {
                    $this->addError($attribute, $ruleName, $ruleData);
                }
                if (self::RULE_MATCH === $ruleName && !$skip && $value !== $this->getAttribute($ruleData['match'])) {
                    $ruleData['match'] = $this->getLabel($ruleData['match']);
                    $this->addError($attribute, $ruleName, $ruleData);
                }
                if (self::RULE_EMAIL === $ruleName && !$skip && !is_email($value)) {
                    $this->addError($attribute, $ruleName);
                }
                if (self::RULE_IN === $ruleName && !$skip && !in_array($value, $ruleData['values'], $ruleData['strict'])) {
                    $this->addError($attribute, $ruleName);
                }
                if (self::RULE_NUMERIC === $ruleName && !$skip && !is_numeric($value)) {
                    $this->addError($attribute, $ruleName);
                }
                if (self::RULE_FILTER_ARRAY === $ruleName && !$skip) {
                    $cases = $ruleData['cases'];
                    $case = $this->{$ruleData['caseAttr']};
                    if (isset($ruleData['keys']) && $ruleData['keys'] === true) {
                        $value = array_intersect_key($value, array_flip($cases[$case]));
                    } else {
                        $value = array_intersect($value, $cases[$case]);
                    }
                    $this->{$attribute} = $value;
                }
            }
        }

        return !$this->hasErrors();
    }

    public function addError(
        string $attribute,
        string $rule,
        array $params = []
    ): void {
        $message = $this->getErrorMessage($rule);
        foreach ($params as $key => $param) {
            if (is_string($param)) {
                $message = str_replace(
                    sprintf('{%s}', $key), $param, $message
                );
            }
        }
        $this->errors[$attribute][] = $message;
    }

    public function addErrorMessage(
        string $attribute,
        string $message,
        array $params = []
    ): void {
        foreach ($params as $key => $param) {
            $message = str_replace(
                sprintf('{%s}', $key), (string) $param, $message
            );
        }
        $this->errors[$attribute][] = $message;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    public function getErrorMessage(string $ruleName): string
    {
        return $this->errorMessages[$ruleName] ?? 'Incorrect value.';
    }

    public function changeErrorMessage(string $attribute, string $message): self
    {
        if (isset($this->errorMessages[$attribute])) {
            $this->errorMessages[$attribute] = $message;
        }

        return $this;
    }

    public function load(array $attributes): bool
    {
        $attrs = $this->attributes;
        $this->setAttributes($attributes);
        return !empty(array_diff($this->attributes, $attrs));
    }

    public function setAttributes(array $attributes): void
    {
        foreach ($attributes as $attribute => $value) {
            $this->setAttribute($attribute, $value);
        }
    }

    public function setAttribute(string $attribute, $value): void
    {
        if (in_array($attribute, $this->supportedAttributes())) {
            $this->{$attribute} = $value;
        }
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getAttribute(string $name)
    {
        return $this->attributes[$name] ?? null;
    }

    public function hasAttribute(string $name): bool
    {
        return isset($this->attributes[$name]);
    }

    public function labels(): array
    {
        $labels = [];
        foreach ($this->supportedAttributes() as $attribute) {
            $labels[$attribute] = ucwords(
                trim(str_replace('_', ' ', $attribute))
            );
        }
        return $labels;
    }

    public function getLabel(string $name): ?string
    {
        return $this->labels()[$name] ?? null;
    }

    public function __set(string $name, $value): void
    {
        if (in_array($name, $this->supportedAttributes())) {
            $this->attributes[$name] = $value;
            return;
        }

        $this->unknownProperty($name);
    }

    public function __get(string $name)
    {
        if (in_array($name, $this->supportedAttributes())) {
            return $this->getAttribute($name);
        }

        $this->unknownProperty($name);
    }
}
