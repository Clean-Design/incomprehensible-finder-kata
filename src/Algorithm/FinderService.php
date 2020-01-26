<?php declare(strict_types = 1);

namespace Kata\Algorithm;

final class FinderService
{
    private const MIN_PERSONS_IN_LIST = 2;

    private FinderStrategy $strategy;
    /** @var Person[] */
    private array $people;

    public function __construct(FinderStrategy $strategy, array $people)
    {
        $this->strategy = $strategy;
        $this->people = $people;
    }

    public function find(): PersonComparison
    {
        if (!$this->validatePersonList()) {
            return PersonComparison::empty();
        }

        return $this->strategy->find($this->getComparisons());
    }

    /**
     * @return PersonComparison[]
     */
    private function getComparisons(): array
    {
        /** @var PersonComparison[] $personComparisons */
        $personComparisons = [];

        foreach ($this->people as $index => $person) {
            $personComparisons = $this->compareWithNext($index + 1, $person, $personComparisons);
        }

        return $personComparisons;
    }

    private function compareWithNext(int $offset, Person $person, array $personComparisons): array
    {
        foreach (array_slice($this->people, $offset) as $personToCompare) {
            $personComparisons[] = PersonComparison::forTwoPeople($person, $personToCompare);
        }

        return $personComparisons;
    }

    private function validatePersonList(): bool
    {
        return count($this->people) >= self::MIN_PERSONS_IN_LIST;
    }
}
