<?php

namespace App;

use DateTime;

class Employee
{
    public function __construct(
        private int      $id,
        private string   $name,
        private int      $salary,
        private DateTime $hireDate,
    ) {
    }

    public function workExperience(): string
    {
        $now = new DateTime();

        return $now->diff($this->hireDate)->format('%Y');
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSalary(): int
    {
        return $this->salary;
    }
}
