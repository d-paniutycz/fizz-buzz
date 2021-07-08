<?php

declare(strict_types=1);

namespace DP\FizzBuzz;

use DP\FizzBuzz\Api\RuleInterface;
use DP\FizzBuzz\Api\RulesetInterface;
use ReflectionClass;
use Countable;

/**
 * Class Ruleset
 * @package DP\FizzBuzz
 */
class Ruleset implements RulesetInterface, Countable
{
    /** @var RuleInterface[] Rules container. */
    protected array $rules = [];

    /**
     * Ruleset constructor.
     *
     * @param RuleInterface ...$rules
     */
    public function __construct(RuleInterface ...$rules)
    {
        foreach ($rules as $rule) {
            $this->add($rule);
        }
    }

    /**
     * Adds a game rule to a ruleset. New rule overrides
     * the old one if the same class name is defined.
     *
     * @param RuleInterface $rule Rule of the game.
     * @return void
     */
    public function add(RuleInterface $rule): void
    {
        //gets the class name without namespace
        $name = (new ReflectionClass($rule))->getShortName();
        $this->rules[$name] = $rule;
    }

    /**
     * @inheritDoc
     */
    public function sort(): void
    {
        $callback = function ($a, $b) {
            return strlen($b) - strlen($a);
        };
        uksort($this->rules, $callback);
    }

    /**
     * @inheritDoc
     */
    public function process(int $number): string
    {
        foreach ($this->rules as $name => $rule) {
            if ($rule->check($number)) {
                return $name;
            }
        }
        return (string)$number;
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->rules);
    }
}
