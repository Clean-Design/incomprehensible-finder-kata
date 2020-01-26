<?php declare(strict_types=1);

namespace Kata\Algorithm\Domain\Service;

use Kata\Algorithm\Application\Find\FinderService;
use Kata\Algorithm\Application\Find\Comparison;

final class FindFurthestService implements FinderService
{
    public function find(array $comparisons): Comparison
    {
        usort(
            $comparisons,
            static function(Comparison $a, Comparison $b) {
                return $a->ageDifference() > $b->ageDifference() ? -1 : 1;
            }
        );

        return $comparisons[0];
    }
}