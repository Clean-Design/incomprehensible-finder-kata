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

        if (FinderMode::closest()->isEqual(FinderMode::fromInteger($mode))) {
            return $this->personCollection->closestComparison();
        }

        if (FinderMode::furthest()->isEqual(FinderMode::fromInteger($mode))) {
            return $this->personCollection->furthestComparison();
        }

        return PersonComparison::empty();
    }

    private function validatePersonList(): bool
    {
        return count($this->personCollection) >= self::MIN_PERSONS_IN_LIST;
    }
}
