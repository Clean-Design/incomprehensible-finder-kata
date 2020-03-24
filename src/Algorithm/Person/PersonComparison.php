<?php declare(strict_types = 1);

namespace Kata\Algorithm\Person;

final class PersonComparison
{
    private ?Person $youngerPerson;
    private ?Person $olderPerson;

    private function __construct(
        ?Person $youngerPerson,
        ?Person $olderPerson
    ) {
        $this->youngerPerson = $youngerPerson;
        $this->olderPerson = $olderPerson;
    }

    public static function forTwoPeople(
        Person $personOne,
        Person $personTwo
    ): self {
        if ($personOne->isOlderThan($personTwo)) {
            return new self($personTwo, $personOne);
        }

        return new self($personOne, $personTwo);
    }

    public static function empty(): self
    {
        return new self(null, null);
    }

    public function youngerPerson(): ?Person
    {
        return $this->youngerPerson;
    }

    public function olderPerson(): ?Person
    {
        return $this->olderPerson;
    }

    public function isClosestThan(PersonComparison $comparison): bool
    {
        return $this->difference() < $comparison->difference();
    }

    private function difference()
    {
        return $this->olderPerson->ageDifference($this->youngerPerson);
    }
}
