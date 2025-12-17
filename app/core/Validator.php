<?php
class Validator
{
    private array $errors = [];

    public function required(string $field, $value): self
    {
        if (trim($value) === '') {
            $this->errors[$field][] = 'This field is required';
        }
        return $this;
    }

    public function min(string $field, $value, int $length): self
    {
        if (strlen($value) < $length) {
            $this->errors[$field][] = "Minimum {$length} characters";
        }
        return $this;
    }

    public function fails(): bool
    {
        return !empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
?>