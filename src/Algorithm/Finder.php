<?php declare(strict_types = 1);

namespace Kata\Algorithm;

final class Finder
{
    private const MIN_PERSONS_IN_LIST = 2;

    /** @var Person[] */
    private array $persons;

    public function __construct(array $persons)
    {
        $this->persons = $persons;
    }

    public function find(int $mode): PersonComparison
    {
        if (!$this->validatePersonList()) {
            return PersonComparison::empty();
        }

        $personComparisons = $this->getComparisons();

        usort(
            $personComparisons,
            static function(PersonComparison $a, PersonComparison $b) {
                return $a->ageDifference() < $b->ageDifference() ? -1 : 1;
            }
        );

        switch ($mode) {
            case FinderMode::CLOSEST:
                return $personComparisons[0];
            case FinderMode::FURTHEST:
                return $personComparisons[count($personComparisons) - 1];
        }

        return PersonComparison::empty();
    }

    /**
     * @return PersonComparison[]
     */
    private function getComparisons(): array
    {
        /** @var PersonComparison[] $personComparisons */
        $personComparisons = [];

        foreach ($this->persons as $index => $person) {
            $personComparisons = $this->compareWithNext($index + 1, $person, $personComparisons);
        }

        return $personComparisons;
    }

    private function compareWithNext(int $offset, Person $person, array $personComparisons): array
    {
        foreach (array_slice($this->persons, $offset) as $personToCompare) {
            $personComparisons[] = PersonComparison::forTwoPeople($person, $personToCompare);
        }

        return $personComparisons;
    }

    private function validatePersonList(): bool
    {
        return count($this->persons) >= self::MIN_PERSONS_IN_LIST;
    }
}
