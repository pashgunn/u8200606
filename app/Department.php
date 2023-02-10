<?php

namespace App;

class Department
{
    /** @var array|Employee[] */
    public array $employees = [];
    public string $title;
    public function __construct(array $employees, string $title)
    {
        $this->employees = $employees;
        $this->title = $title;
    }

    public function totalEmployeesSalaries(): int
    {
        $total = 0;
        foreach ($this->employees as $employee) {
            $total += $employee->salary;
        }
        return $total;
    }
}
