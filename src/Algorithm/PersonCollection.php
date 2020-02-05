<?php declare(strict_types=1);

namespace Kata\Algorithm;

use Countable;

final class PersonCollection implements Countable
{
    /** @var Person[] */
    private array $persons;

    public function __construct(array $persons)
    {
        $this->persons = $persons;
    }

    public function count(): int
    {
        return count($this->persons);
    }

    /**
     * @return PersonComparison[]
     */
    public function compare(): array
    {
        /** @var PersonComparison[] $personComparisons */
        $personComparisons = [];

        foreach ($this->persons as $index => $person) {
            foreach (array_slice($this->persons, $index + 1) as $personToCompare) {
                $personComparisons[] = PersonComparison::forTwoPeople($person, $personToCompare);
            }
        }

        usort(
            $personComparisons,
            static function(PersonComparison $a, PersonComparison $b) {
                return $a->ageDifference() < $b->ageDifference() ? -1 : 1;
            }
        );

        return $personComparisons;
    }
}
