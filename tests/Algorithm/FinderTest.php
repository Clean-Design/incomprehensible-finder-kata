<?php declare(strict_types = 1);

namespace Kata\Tests\Algorithm;

use Kata\Algorithm\Finder\Finder;
use Kata\Algorithm\Finder\Mode\ClosestFinderMode;
use Kata\Algorithm\Finder\Mode\FurthestFinderMode;
use Kata\Algorithm\Person\Person;
use PHPUnit\Framework\TestCase;
use DateTime;

final class FinderTest extends TestCase
{
    private const CLOSEST_MODE = 1;
    private const FURTHEST_MODE = 2;
    private const AN_INVALID_FINDER_MODE = 666;

    private Person $sue;
    private Person $greg;
    private Person $sarah;
    private Person $mike;

    protected function setUp(): void
    {
        $this->sue = new Person("Sue", new DateTime("1950-01-01"));
        $this->greg = new Person("Greg", new DateTime("1952-05-01"));
        $this->sarah = new Person("Sarah", new DateTime("1982-01-01"));
        $this->mike = new Person("Mike", new DateTime("1979-01-01"));
    }

    /** @test */
    public function should_return_empty_when_given_empty_list(): void
    {
        $result = $this->closestFinder([])->find(self::CLOSEST_MODE);

        $this->assertEquals(null, $result->youngerPerson());
        $this->assertEquals(null, $result->olderPerson());
    }

    /** @test */
    public function should_return_empty_when_given_one_person(): void
    {
        $result = $this->closestFinder([$this->sue])->find(self::CLOSEST_MODE);

        $this->assertEquals(null, $result->youngerPerson());
        $this->assertEquals(null, $result->olderPerson());
    }

    /** @test */
    public function should_return_closest_two_for_two_people(): void
    {
        $result = $this->closestFinder([
            $this->sue,
            $this->greg,
        ])->find(self::CLOSEST_MODE);

        $this->assertEquals($this->sue, $result->youngerPerson());
        $this->assertEquals($this->greg, $result->olderPerson());
    }

    /** @test */
    public function should_return_furthest_two_for_two_people(): void
    {
        $result = $this->furthestFinder([
            $this->mike,
            $this->greg
        ])->find(self::FURTHEST_MODE);

        $this->assertEquals($this->greg, $result->youngerPerson());
        $this->assertEquals($this->mike, $result->olderPerson());
    }

    /** @test */
    public function should_return_furthest_two_for_four_people(): void
    {
        $result = $this->furthestFinder([
            $this->sue,
            $this->sarah,
            $this->mike,
            $this->greg
        ])->find(self::FURTHEST_MODE);

        $this->assertEquals($this->sue, $result->youngerPerson());
        $this->assertEquals($this->sarah, $result->olderPerson());
    }

    /** @test */
    public function should_return_closest_two_for_four_people(): void
    {
        $result = $this->closestFinder([
            $this->sue,
            $this->sarah,
            $this->mike,
            $this->greg
        ])->find(self::CLOSEST_MODE);

        $this->assertEquals($this->sue, $result->youngerPerson());
        $this->assertEquals($this->greg, $result->olderPerson());
    }

    /** @test */
    public function shouldReturnEmptyWhenGivenAnInvalidMode(): void
    {
        $result = $this->closestFinder([
            $this->sue,
            $this->sarah
        ])->find(self::AN_INVALID_FINDER_MODE);

        $this->assertEquals(null, $result->youngerPerson());
        $this->assertEquals(null, $result->olderPerson());
    }

    private function closestFinder(array $people): Finder
    {
        return new Finder($people, ClosestFinderMode::create());
    }

    private function furthestFinder(array $people): Finder
    {
        return new Finder($people, FurthestFinderMode::create());
    }
}
