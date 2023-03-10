<?php

namespace App;

class Department
{

    public function __construct(
        private array  $employees,
        private string $name
    )
    {
    }

    public function getTotalSalary(): int
    {
        $total = 0;
        foreach ($this->employees as $employee) {
            $total += $employee->getSalary();
        }
        return $total;
    }

    public function getEmployees(): array
    {
        return $this->employees;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
