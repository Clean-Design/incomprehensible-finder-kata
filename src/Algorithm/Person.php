<?php declare(strict_types = 1);

namespace Kata\Algorithm;

use DateTime;

final class Person
{
    private string $name;
    private DateTime $birthDate;

    public function __construct(
        string $name,
        DateTime $birthDate
    ) {
        $this->name = $name;
        $this->birthDate = $birthDate;
    }

    public function isOlderThan(Person $person): bool
    {
        return $this->birthDate > $person->birthDate;
    }

    public function ageDifference(Person $youngerPerson): int
    {
        return $this->birthDate->getTimestamp() - $youngerPerson->birthDate->getTimestamp();
    }
}
