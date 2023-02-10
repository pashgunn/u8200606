<?php

require 'vendor/autoload.php';

use App\Department;
use App\Employee;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Validation;

$validator = Validation::createValidator();

$violations = [];
$employees1[] = new Employee(1, 'John', 15000, new DateTime('2009-01-01'));
$employees1[] = new Employee(2, 'Michael', 50000, new DateTime('2010-01-01'));

$employees2[] = new Employee(3, 'Paul', 10000, new DateTime('2002-01-01'));

$employees3[] = new Employee(4, 'Joe', 32000, new DateTime('2012-01-01'));
$employees3[] = new Employee(5, 'Suzy', 5000, new DateTime('2013-01-01'));
$employees3[] = new Employee(6, 'Michel', 22000, new DateTime('2016-01-01'));

$employees = [$employees1, $employees2, $employees3];
foreach ($employees as $item) {
    foreach ($item as $employee) {
        echo $employee->workExperience();
        $violations[] = $validator->validate($employee->id, [
            new Positive(),
        ]);
        $violations[] = $validator->validate($employee->name, [
            new NotBlank(),
            new NotNull(),
            new Length(['min' => 4, 'max' => 10])
        ]);
        $violations[] = $validator->validate($employee->salary, [
            new Positive(),
        ]);
    }
}

if (0 !== count($violations)) {
    // there are errors, now you can show them
    foreach ($violations as $items) {
        foreach ($items as $violation) {
            echo $violation->getMessage() . PHP_EOL;
        }
    }
}

function arraySort(array $array, ): array
{
    usort($array, static function ($a, $b) use ($key, $sort) {
        return $a[$key] <=> $b[$key];
    });
    return $array;
}

$departments = [];
$departments[] = new Department($employees1, 'Название 1');
$departments[] = new Department($employees2, 'Название 2');
$departments[] = new Department($employees3, 'Название 3');
echo $departments[0]->totalEmployeesSalaries();
foreach ($departments as $department) {
    $salaries[] = $department->totalEmployeesSalaries();
}