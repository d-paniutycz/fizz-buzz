<?php

declare(strict_types=1);

namespace DP\FizzBuzz\Api;

/**
 * Interface RuleInterface
 * @package DP\FizzBuzz\Api
 */
interface RuleInterface
{
    /**
     * Checks the given number if it matches a rule.
     *
     * @param int $number Number to check.
     * @return bool Result of the check.
     */
    public function check(int $number): bool;
}
