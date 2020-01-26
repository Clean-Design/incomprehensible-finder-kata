<?php declare(strict_types=1);

namespace Kata\Algorithm;

interface FinderStrategy
{
    /** @param PersonComparison[] $comparisons */
    public function find(array $comparisons);
}