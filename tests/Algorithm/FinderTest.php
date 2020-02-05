<?php declare(strict_types = 1);

namespace Kata\Tests\Algorithm;

use Kata\Algorithm\Finder;
use Kata\Algorithm\Person;
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
        $list   = [];
        $finder = new Finder($list);

        $result = $finder->find(self::CLOSEST_MODE);

        $this->assertEquals(null, $result->youngerPerson());
        $this->assertEquals(null, $result->olderPerson());
    }

    /** @test */
    public function should_return_empty_when_given_one_person(): void
    {
        $list   = [];
        $list[] = $this->sue;
        $finder = new Finder($list);

        $result = $finder->find(self::CLOSEST_MODE);

        $this->assertEquals(null, $result->youngerPerson());
        $this->assertEquals(null, $result->olderPerson());
    }

    /** @test */
    public function should_return_closest_two_for_two_people(): void
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(self::CLOSEST_MODE);

        $this->assertEquals($this->sue, $result->youngerPerson());
        $this->assertEquals($this->greg, $result->olderPerson());
    }

    /** @test */
    public function should_return_furthest_two_for_two_people(): void
    {
        $list   = [];
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(self::FURTHEST_MODE);

        $this->assertEquals($this->greg, $result->youngerPerson());
        $this->assertEquals($this->mike, $result->olderPerson());
    }

    /** @test */
    public function should_return_furthest_two_for_four_people(): void
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        shuffle($list);
        $finder = new Finder($list);

        $result = $finder->find(self::FURTHEST_MODE);

        $this->assertEquals($this->sue, $result->youngerPerson());
        $this->assertEquals($this->sarah, $result->olderPerson());
    }

    /** @test */
    public function should_return_closest_two_for_four_people(): void
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(self::CLOSEST_MODE);

        $this->assertEquals($this->sue, $result->youngerPerson());
        $this->assertEquals($this->greg, $result->olderPerson());
    }

    /** @test */
    public function shouldReturnEmptyWhenGivenAnInvalidMode(): void
    {
        $finder = new Finder([
            $this->sue,
            $this->sarah,
        ]);

        $result = $finder->find(self::AN_INVALID_FINDER_MODE);

        $this->assertEquals(null, $result->youngerPerson());
        $this->assertEquals(null, $result->olderPerson());
    }
}
