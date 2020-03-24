<?php declare(strict_types = 1);

namespace Kata\Algorithm\Finder;

use Kata\Algorithm\Finder\Mode\FinderMode;
use Kata\Algorithm\Finder\Mode\FinderModeInterface;
use Kata\Algorithm\Person\PersonCollection;
use Kata\Algorithm\Person\PersonComparison;

final class Finder
{
    private const MIN_PERSONS_IN_LIST = 2;

    private PersonCollection $personCollection;
    private FinderModeInterface $finderMode;

    public function __construct(array $people, FinderModeInterface $finderMode)
    {
        $this->personCollection = new PersonCollection($people);
        $this->finderMode = $finderMode;
    }

    public function find(int $mode): PersonComparison
    {
        if (!$this->validatePersonList()) {
            return PersonComparison::empty();
        }

        if ($this->finderMode->canFind($mode)) {
            return $this->finderMode->find($this->personCollection);
        }

        return PersonComparison::empty();
    }

    private function validatePersonList(): bool
    {
        return count($this->personCollection) >= self::MIN_PERSONS_IN_LIST;
    }
}
