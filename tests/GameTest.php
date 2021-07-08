<?php

declare(strict_types=1);

namespace DP\FizzBuzz;

use PHPUnit\Framework\TestCase;
use ArgumentCountError;

/**
 * Class GameTest
 * @package DP\FizzBuzz
 * @group Core
 */
final class GameTest extends TestCase
{
    /** @var Ruleset Mock of a ruleset. */
    private Ruleset $rulesetMock;

    /**
     * Setup of the mock for a test object.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->rulesetMock = $this->getMockBuilder(Ruleset::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['sort', 'process'])
            ->getMock();
    }

    /**
     * Game fails if no ruleset given.
     *
     * @return void
     */
    public function testGameFailsIfNoRulesetGiven(): void
    {
        $this->expectException(ArgumentCountError::class);
        /** @noinspection PhpParamsInspection, PhpExpressionResultUnusedInspection */
        new Game();
    }

    /**
     * Counter processes if valid limit is greater than zero.
     *
     * @return void
     */
    public function testCounterProcessesIfLimitIsGreaterThanZero(): void
    {
        $this->rulesetMock->expects($this->exactly(1))->method('sort');
        $this->rulesetMock->expects($this->exactly(3))->method('process')->willReturn('');

        $result = (new Game($this->rulesetMock))->countTo(3);
        $this->assertCount(3, $result);
    }

    /**
     * Counter returns empty array if limit is lesser than one.
     *
     * @return void
     */
    public function testCounterReturnsEmptyArrayIfLimitIsLesserThanOne(): void
    {
        $result = (new Game($this->rulesetMock))->countTo(-1);
        $this->assertEmpty($result);
    }
}
