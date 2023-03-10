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

$employees4[] = new Employee(7, 'Test', 10000, new DateTime('2002-01-01'));

$employees = [$employees1, $employees2, $employees3, $employees4];
foreach ($employees as $item) {
    foreach ($item as $employee) {
        echo 'Опыт работы сотрудника ' . $employee->getName() . ': ' . $employee->workExperience() . ' лет <br>';
        $violations[] = $validator->validate($employee->getId(), [
            new Positive(),
        ]);
        $violations[] = $validator->validate($employee->getName(), [
            new NotBlank(),
            new NotNull(),
            new Length(['min' => 4, 'max' => 10])
        ]);
        $violations[] = $validator->validate($employee->getSalary(), [
            new Positive(),
        ]);
    }
}

if (0 !== count($violations)) {
    // there are errors, now you can show them
    foreach ($violations as $items) {
        foreach ($items as $violation) {
            echo $violation->getMessage() . '<br>';
        }
    }
}


//task2

$department1 = new Department($employees1, "Отдел продаж");
$department2 = new Department($employees2, "Отдел производства");
$department3 = new Department($employees3, "Отдел разработки");
$department4 = new Department($employees4, "Отдел тестирования");

$departments = [$department1, $department2, $department3, $department4];

usort($departments, function ($a, $b) {
    $salaryDiff = $b->getTotalSalary() - $a->getTotalSalary();
    $employeeDiff = count($b->getEmployees()) - count($a->getEmployees());
    return $salaryDiff !== 0 ? $salaryDiff : $employeeDiff;
});

$firstDepartment = reset($departments);
$lastDepartment = end($departments);

$highestSalary = $firstDepartment->getTotalSalary();
$lowestSalary = $lastDepartment->getTotalSalary();

echo "Отделы с наибольшим размером суммарной зарплаты: <br>";
foreach ($departments as $department) {
    if ($department->getTotalSalary() === $highestSalary && count($department->getEmployees()) === count($firstDepartment->getEmployees())) {
        echo $department->getName() . "<br>";
    } else {
        break;
    }
}

echo "Отделы с наименьшим размером суммарной зарплаты:<br>";
foreach (array_reverse($departments) as $department) {
    if ($department->getTotalSalary() === $lowestSalary && count($department->getEmployees()) === count($lastDepartment->getEmployees())) {
        echo $department->getName() . "<br>";
    } else {
        break;
    }
}
