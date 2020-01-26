<?php declare(strict_types=1);

namespace Kata\Algorithm\Application\Find;

final class FindResult
{
    private Comparison $comparison;

    public function __construct(Comparison $comparison)
    {
        $this->comparison = $comparison;
    }

    public function comparison(): Comparison
    {
        return $this->comparison;
    }
}