<?php declare(strict_types=1);

namespace Kata\Algorithm\Application\Find;

interface FinderService
{
    /** @param Comparison[] $comparisons */
    public function find(array $comparisons): Comparison;
}