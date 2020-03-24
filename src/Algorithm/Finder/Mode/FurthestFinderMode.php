<?php declare(strict_types = 1);

namespace Kata\Algorithm\Finder\Mode;

use Kata\Algorithm\Person\PersonCollection;
use Kata\Algorithm\Person\PersonComparison;

final class FurthestFinderMode implements FinderModeInterface
{
    private const MODE = 2;

    private int $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function create()
    {
        return new self(self::MODE);
    }

    public function canFind(int $mode): bool
    {
        return $mode === self::MODE;
    }

    public function find(PersonCollection $people): PersonComparison
    {
        return $people->furthestComparison();
    }
}
