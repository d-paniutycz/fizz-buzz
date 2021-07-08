<?php

declare(strict_types=1);

namespace DP\FizzBuzz\Rule;

use PHPUnit\Framework\TestCase;

/**
 * Class FizzTest
 * @package DP\FizzBuzz\Rule
 * @group Rules
 */
final class FizzTest extends TestCase
{
    /** @var Fizz Test object. */
    private Fizz $rule;

    /**
     * Setup of a test object.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->rule = new Fizz();
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
     * @see Fizz::check()
     * @return int[][]
     */
    public function validNumbersProvider(): array
    {
        return [[3], [6], [9]];
    }

    /**
     * Invalid numbers have a division remainder.
     *
     * @see Fizz::check()
     * @return int[][]
     */
    public function invalidNumbersProvider(): array
    {
        return [[4], [7], [10]];
    }
}
