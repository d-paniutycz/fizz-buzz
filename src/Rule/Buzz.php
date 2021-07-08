<?php

declare(strict_types=1);

namespace DP\FizzBuzz\Rule;

use DP\FizzBuzz\Api\RuleInterface;

/**
 * Class Buzz
 * @package DP\FizzBuzz\Rule
 */
class Buzz implements RuleInterface
{
    /**
     * @inheritDoc
     */
    public function check(int $number): bool
    {
        return $number % 5 === 0;
    }
}
