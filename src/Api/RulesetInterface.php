<?php

declare(strict_types=1);

namespace DP\FizzBuzz\Api;

/**
 * Interface RulesetInterface
 * @package DP\FizzBuzz\Api
 */
interface RulesetInterface
{
    /**
     * Sorts rules by the name (key) length. The most complex
     * rules must be executed before less complex ones.
     *
     * @return void
     */
    public function sort(): void;

    /**
     * Processes the given number according to a ruleset.
     *
     * @param int $number Number to process.
     * @return string Result of the process.
     */
    public function process(int $number): string;
}
