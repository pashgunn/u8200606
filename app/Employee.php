<?php

namespace App;

use DateTime;

class Employee
{
    public function __construct(
        public int      $id,
        public string   $name,
        public int      $salary,
        public DateTime $hireDate,
    ) {
    }

    public function workExperience(): string
    {
        $now = new DateTime();

        return $now->diff($this->hireDate)->format('%Y') . PHP_EOL;
    }
}
