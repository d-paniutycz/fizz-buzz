<?php

declare(strict_types=1);

namespace DP\FizzBuzz\Rule;

use PHPUnit\Framework\TestCase;

/**
 * Class FizzBuzzTest
 * @package DP\FizzBuzz\Rule
 * @group Rules
 */
final class FizzBuzzTest extends TestCase
{
    /** @var FizzBuzz Test object. */
    private FizzBuzz $rule;

    /**
     * Setup of a test object.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->rule = new FizzBuzz();
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
     * @see FizzBuzz::check()
     * @return int[][]
     */
    public function validNumbersProvider(): array
    {
        return [[15], [30], [45]];
    }

    /**
     * Invalid numbers have a division remainder.
     *
     * @see FizzBuzz::check()
     * @return int[][]
     */
    public function invalidNumbersProvider(): array
    {
        return [[16], [31], [46]];
    }
}
