<?php declare(strict_types = 1);

namespace Kata\Algorithm;

final class FinderMode
{
    private const CLOSEST = 1;
    private const FURTHEST = 2;

    private int $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function closest(): self
    {
        return new self(self::CLOSEST);
    }

    public static function furthest(): self
    {
        return new self(self::FURTHEST);
    }

    public static function fromInteger(int $value): self
    {
        return new self($value);
    }

    public function isEqual(FinderMode $mode): bool
    {
        return $mode->value === $this->value;
    }
}
