<?php declare(strict_types=1);

namespace Kata\Algorithm\Finder\Mode;

use Kata\Algorithm\Person\PersonCollection;
use Kata\Algorithm\Person\PersonComparison;

interface FinderModeInterface
{
    public function canFind(int $mode): bool;

    public function find(PersonCollection $people): PersonComparison;
}
