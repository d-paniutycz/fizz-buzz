<?php

declare(strict_types=1);

namespace DP\FizzBuzz\Rule;

use DP\FizzBuzz\Api\RuleInterface;

/**
 * Class FizzBuzz
 * @package DP\FizzBuzz\Rule
 */
class FizzBuzz implements RuleInterface
{
    /**
     * @inheritDoc
     */
    public function check(int $number): bool
    {
        return $number % 3 === 0 && $number % 5 === 0;
    }
}
