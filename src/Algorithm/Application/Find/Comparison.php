<?php declare(strict_types = 1);

namespace Kata\Algorithm\Application\Find;

use Kata\Algorithm\Domain\Person;

final class Comparison
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
        if ($personOne->birthDate() < $personTwo->birthDate()) {
            return new self($personOne, $personTwo);
        } else {
            return new self($personTwo, $personOne);
        }
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

    public function ageDifference() {
        return $this->olderPerson->birthDate()->getTimestamp() - $this->youngerPerson->birthDate()->getTimestamp();
    }
}
