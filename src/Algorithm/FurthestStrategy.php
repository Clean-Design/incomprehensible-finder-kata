<?php declare(strict_types=1);

namespace Kata\Algorithm;

final class FurthestStrategy implements FinderStrategy
{
    public function find(array $comparisons)
    {
        usort(
            $comparisons,
            static function(PersonComparison $a, PersonComparison $b) {
                return $a->ageDifference() > $b->ageDifference() ? -1 : 1;
            }
        );

        return $comparisons[0];
    }
}