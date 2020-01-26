<?php declare(strict_types = 1);

namespace Kata\Algorithm\Application\Find;

use Kata\Algorithm\Domain\Person;

final class FindUseCase
{
    private const MIN_PERSONS_IN_LIST = 2;

    private FinderService $strategy;

    public function __construct(FinderService $strategy)
    {
        $this->strategy = $strategy;
    }

    public function execute(FindRequest $request): FindResult
    {
        if (!$this->validateRequest($request)) {
            return new FindResult(Comparison::empty());
        }

        return new FindResult($this->strategy->find($this->getComparisons($request->people())));
    }

    /**
     * @param Person[] $people
     *
     * @return Comparison[]
     */
    private function getComparisons(array $people): array
    {
        /** @var Comparison[] $comparisons */
        $comparisons = [];

        foreach ($people as $index => $person) {
            $comparisons = $this->compareWithNext(array_slice($people, $index + 1), $person, $comparisons);
        }

        return $comparisons;
    }

    private function compareWithNext(array $people, Person $person, array $comparisons): array
    {
        foreach ($people as $personToCompare) {
            $comparisons[] = Comparison::forTwoPeople($person, $personToCompare);
        }

        return $comparisons;
    }

    private function validateRequest(FindRequest $request): bool
    {
        return count($request->people()) >= self::MIN_PERSONS_IN_LIST;
    }
}
