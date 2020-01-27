<?php declare(strict_types = 1);

namespace Kata\Tests\Algorithm;

use Kata\Algorithm\Finder;
use Kata\Algorithm\FT;
use Kata\Algorithm\Thing;
use PHPUnit\Framework\TestCase;
use DateTime;

final class FinderTest extends TestCase
{
    private Thing $sue;
    private Thing $greg;
    private Thing $sarah;
    private Thing $mike;

    protected function setUp(): void
    {
        $this->sue            = new Thing();
        $this->sue->name      = "Sue";
        $this->sue->birthDate = new DateTime("1950-01-01");

        $this->greg            = new Thing();
        $this->greg->name      = "Greg";
        $this->greg->birthDate = new DateTime("1952-05-01");

        $this->sarah            = new Thing();
        $this->sarah->name      = "Sarah";
        $this->sarah->birthDate = new DateTime("1982-01-01");

        $this->mike            = new Thing();
        $this->mike->name      = "Mike";
        $this->mike->birthDate = new DateTime("1979-01-01");
    }

    /** @test */
    public function shouldReturnEmptyWhenGivenEmptyList(): void
    {
        $list   = [];
        $finder = new Finder($list);

        $result = $finder->find(FT::ONE);

        $this->assertEquals(null, $result->p1);
        $this->assertEquals(null, $result->p2);
    }

    /** @test */
    public function shouldReturnEmptyWhenGivenOnePerson(): void
    {
        $list   = [];
        $list[] = $this->sue;
        $finder = new Finder($list);

        $result = $finder->find(FT::ONE);

        $this->assertEquals(null, $result->p1);
        $this->assertEquals(null, $result->p2);
    }

    /** @test */
    public function shouldReturnClosestTwoForTwoPeople(): void
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(FT::ONE);

        $this->assertEquals($this->sue, $result->p1);
        $this->assertEquals($this->greg, $result->p2);
    }

    /** @test */
    public function shouldReturnFurthestTwoForTwoPeople(): void
    {
        $list   = [];
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(FT::TWO);

        $this->assertEquals($this->greg, $result->p1);
        $this->assertEquals($this->mike, $result->p2);
    }

    /** @test */
    public function shouldReturnFurthestTwoForFourPeople(): void
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(FT::TWO);

        $this->assertEquals($this->sue, $result->p1);
        $this->assertEquals($this->sarah, $result->p2);
    }

    /** @test */
    public function shouldReturnClosestTwoForFourPeople(): void
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(FT::ONE);

        $this->assertEquals($this->sue, $result->p1);
        $this->assertEquals($this->greg, $result->p2);
    }
}
