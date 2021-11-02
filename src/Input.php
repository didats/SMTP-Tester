<?php

class Input {
    public $type, $label, $placeholder, $name, $value;
    public function __construct(string $type, string $label, string $placeholder, string $name, string $value = "")
    {
        $this->type = $type;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->value = $value;
    }

    public static function fromPost($key): string {
        return (isset($_POST[$key])) ? $_POST[$key] : "";
    }
}