<?php


namespace App\Components;


class Validator
{
    private $rules = [
        'required' => [
            'regex' => true,
            'pattern' => "[a-zA-Zа-яА-Я0-9]+"
        ],
        'number' => [
            'regex' => true,
            'pattern' => "[0-9]+"
        ],
        'password_confirm' => [
            'regex' => false,
            'pattern' => 'password_confirm'
        ]
    ];
    private $messages = [];
    private $errors = [];

    private function setMessages(array $messages)
    {
        foreach ($messages as $field => $msg) {
            $sgm = explode(".", $field);
            $this->messages[$sgm[0]][$sgm[1]] = $msg;
        }
    }

    public static function validate(array $data, array $rules, $messages = [])
    {
        $instance = new static;
        $instance->setMessages($messages);
        foreach ($data as $field => $value) {
            if (isset($rules[$field])) {
                foreach ($rules[$field] as $rule) {
                    if (isset($instance->rules[$rule]) && $instance->rules[$rule]['regex']) {
                        $instance->checkRule($rule, $field, $value);
                    } elseif(isset($instance->rules[$rule]) && !$instance->rules['rule']['regex']) {
                        $instance->checkSpecialRule($rule, $field, $value, $data);
                    }
                }
            }
        }
        return $instance;
    }

    protected function checkRule(string $rule, $field, $value)
    {
        if (isset($this->rules[$rule])) {
            $pattern = "~" . $this->rules[$rule]['pattern'] . "~";
            if (!preg_match($pattern, $value)) {
                if (isset($this->messages[$field][$rule])) {
                    $this->errors[$field][] = $this->messages[$field][$rule];
                }
            }
        } else {
            throw new \Exception("Erorr: Unknown validation rule: " . $rule);
        }
    }

    protected function checkSpecialRule(string $rule, $field, $value, $data = [])
    {
        switch ($rule) {
            case "password_confirm":
                if ($value != $data['password_confirm']) {
                    $this->errors[$field][] = $this->messages[$field][$rule];
                }
                break;
        }
    }

    public function getErrorsCount()
    {
        return count($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}