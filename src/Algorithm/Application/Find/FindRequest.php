<?php declare(strict_types=1);

namespace Kata\Algorithm\Application\Find;

use Kata\Algorithm\Domain\Person;

final class FindRequest
{
    /** @var Person[] */
    private array $people;

    public function __construct(array $people)
    {
        $this->people = $people;
    }

    /** @return Person[] */
    public function people(): array
    {
        return $this->people;
    }
}