<?php

declare(strict_types=1);

namespace DP\FizzBuzz\Rule;

use DP\FizzBuzz\Api\RuleInterface;

/**
 * Class Fizz
 * @package DP\FizzBuzz\Rule
 */
class Fizz implements RuleInterface
{
    /**
     * @inheritDoc
     */
    public function check(int $number): bool
    {
        return $number % 3 === 0;
    }
}
