<?php

declare(strict_types=1);

namespace DP\FizzBuzz\Rule;

use PHPUnit\Framework\TestCase;

/**
 * Class BuzzTest
 * @package DP\FizzBuzz\Rule
 * @group Rules
 */
final class BuzzTest extends TestCase
{
    /** @var Buzz Test object. */
    private Buzz $rule;

    /**
     * Setup of a test object.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->rule = new Buzz();
    }

    /**
     * @dataProvider validNumbersProvider
     * @param int $number
     * @return void
     */
    public function testCheckSuccessOnValidNumber(int $number): void
    {
        $this->assertTrue($this->rule->check($number));
    }

    /**
     * @dataProvider invalidNumbersProvider
     * @param int $number
     * @return void
     */
    public function testCheckFailsOnInvalidNumber(int $number): void
    {
        $this->assertFalse($this->rule->check($number));
    }

    /**
     * Valid numbers do not have a remainder from the division.
     *
     * @see Buzz::check()
     * @return int[][]
     */
    public function validNumbersProvider(): array
    {
        return [[5], [10], [15]];
    }

    /**
     * Invalid numbers have a division remainder.
     *
     * @see Buzz::check()
     * @return int[][]
     */
    public function invalidNumbersProvider(): array
    {
        return [[6], [11], [16]];
    }
}
