<?php

declare(strict_types=1);

class ResultContainer
{
    public $errors = [];

    public function addError($key, $value) {
        $this->errors[$key] = $value;
    }

    public function isEmpty(){
        return empty($this->errors);
    }

    public function getErrors() {
        return $this->errors;

    }
}
