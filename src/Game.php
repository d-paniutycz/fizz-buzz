<?php

declare(strict_types=1);

namespace DP\FizzBuzz;

use DP\FizzBuzz\Api\GameInterface;
use DP\FizzBuzz\Api\RulesetInterface;

/**
 * Class Game
 * @package DP\FizzBuzz
 */
class Game implements GameInterface
{
    /**
     * Game constructor.
     *
     * @param RulesetInterface $ruleset
     */
    public function __construct(protected RulesetInterface $ruleset)
    {
    }

    /**
     * @inheritDoc
     */
    public function countTo(int $limit): array
    {
        if ($limit > 0) {
            //ruleset must be sorted before counting
            $this->ruleset->sort();
            for ($i = 1; $i <= $limit; $i++) {
                $result[$i] = $this->ruleset->process($i);
            }
        }
        return $result ?? [];
    }
}
