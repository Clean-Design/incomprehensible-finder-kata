<?php declare(strict_types = 1);

namespace Kata\Algorithm;

final class Finder
{
    private const MIN_PERSONS_IN_LIST = 2;

    private PersonCollection $personCollection;

    public function __construct(array $persons)
    {
        $this->personCollection = new PersonCollection($persons);
    }

    public function find(int $mode): PersonComparison
    {
        if (!$this->validatePersonList()) {
            return PersonComparison::empty();
        }

        $personComparisons = $this->personCollection->compare();

        if (FinderMode::closest()->isEqual(FinderMode::fromInteger($mode))) {
            return $personComparisons[0];
        }

        if (FinderMode::furthest()->isEqual(FinderMode::fromInteger($mode))) {
            return $personComparisons[count($personComparisons) - 1];
        }

        return PersonComparison::empty();
    }

    private function validatePersonList(): bool
    {
        return count($this->personCollection) >= self::MIN_PERSONS_IN_LIST;
    }
}
