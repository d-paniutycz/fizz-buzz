<?php

error_reporting(E_ALL);

include('../vendor/autoload.php');

use DP\FizzBuzz;
use DP\FizzBuzz\Rule;

$ruleset = new FizzBuzz\Ruleset(new Rule\Fizz(), new Rule\Buzz(), new Rule\FizzBuzz());
$game = new FizzBuzz\Game($ruleset);

class Fizz implements DP\FizzBuzz\Api\RuleInterface
{
    public function check(int $number): bool
    {
        return $number % 4 === 0;
    }
}
//adding a new rule with the same class name will override the old one regardless namespace
$ruleset->add(new Fizz());

class FizzBuzzBazz extends DP\FizzBuzz\Rule\FizzBuzz
{
    public function check(int $number): bool
    {
        return parent::check($number) && $number % 7 === 0;
    }
}
//new rules can be composed by using parent logic or/and constructor
$ruleset->add(new FizzBuzzBazz());

//new ruleset: Fizz, Rule\Buzz, Rule\FizzBuzz, FizzBuzzBazz
$result = $game->countTo(105);
//result for Fizz was changed and the new rule FizzBuzzBazz was applied
echo 'Game result: <pre>' . print_r($result, true) . '</pre>';
