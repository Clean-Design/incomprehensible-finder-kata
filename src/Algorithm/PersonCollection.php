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

    public function closestComparison(): PersonComparison
    {
        return $this->compare()[0];
    }

    public function furthestComparison(): PersonComparison
    {
        $comparisons = $this->compare();

        return $comparisons[count($comparisons) - 1];
    }

    /**
     * @return PersonComparison[]
     */
    private function compare(): array
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
            static function(PersonComparison $personComparison, PersonComparison $nextPersonComparison) {
                return $personComparison->isClosestThan($nextPersonComparison) ? -1 : 1;
            }
        );

        return $personComparisons;
    }
}
