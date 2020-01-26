<?php declare(strict_types = 1);

namespace Kata\Tests\Algorithm;

use Kata\Algorithm\Application\Find\FindRequest;
use Kata\Algorithm\Application\Find\FindUseCase;
use Kata\Algorithm\Domain\Person;
use Kata\Algorithm\Domain\Service\FindClosestService;
use Kata\Algorithm\Domain\Service\FindFurthestService;
use PHPUnit\Framework\TestCase;
use DateTime;

final class FinderTest extends TestCase
{
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
        $result = $this->closestUseCase()->execute(
            new FindRequest([])
        );

        $this->assertEquals(null, $result->comparison()->youngerPerson());
        $this->assertEquals(null, $result->comparison()->olderPerson());
    }

    /** @test */
    public function should_return_empty_when_given_one_person(): void
    {
        $result = $this->closestUseCase()->execute(
            new FindRequest([
                $this->sue
            ])
        );

        $this->assertEquals(null, $result->comparison()->youngerPerson());
        $this->assertEquals(null, $result->comparison()->olderPerson());
    }

    /** @test */
    public function should_return_closest_two_for_two_people(): void
    {
        $result = $this->closestUseCase()->execute(
            new FindRequest([
                $this->sue,
                $this->greg
            ])
        );

        $this->assertEquals($this->sue, $result->comparison()->youngerPerson());
        $this->assertEquals($this->greg, $result->comparison()->olderPerson());
    }

    /** @test */
    public function should_return_furthest_two_for_two_people(): void
    {
        $result = $this->furthestUseCase()->execute(
            new FindRequest([
                $this->mike,
                $this->greg
            ])
        );

        $this->assertEquals($this->greg, $result->comparison()->youngerPerson());
        $this->assertEquals($this->mike, $result->comparison()->olderPerson());
    }

    /** @test */
    public function should_return_furthest_two_for_four_people(): void
    {
        $result = $this->furthestUseCase()->execute(
            new FindRequest([
                $this->sue,
                $this->sarah,
                $this->mike,
                $this->greg
            ])
        );

        $this->assertEquals($this->sue, $result->comparison()->youngerPerson());
        $this->assertEquals($this->sarah, $result->comparison()->olderPerson());
    }

    /** @test */
    public function should_return_closest_two_for_four_people(): void
    {
        $result = $this->closestUseCase()->execute(
            new FindRequest([
                $this->sue,
                $this->sarah,
                $this->mike,
                $this->greg
            ])
        );

        $this->assertEquals($this->sue, $result->comparison()->youngerPerson());
        $this->assertEquals($this->greg, $result->comparison()->olderPerson());
    }

    private function closestUseCase(): FindUseCase
    {
        return new FindUseCase(
            new FindClosestService()
        );
    }

    private function furthestUseCase(): FindUseCase
    {
        return new FindUseCase(
            new FindFurthestService()
        );
    }
}
