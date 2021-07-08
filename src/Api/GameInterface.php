<?php

declare(strict_types=1);

namespace DP\FizzBuzz\Api;

/**
 * Interface GameInterface
 * @package DP\FizzBuzz\Api
 */
interface GameInterface
{
    /**
     * Starts the game and counts to the specified limit.
     *
     * @param int $limit Limits the number of iterations.
     * @return array Result of the game.
     */
    public function countTo(int $limit): array;
}
