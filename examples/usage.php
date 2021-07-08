<?php

error_reporting(E_ALL);

include('../vendor/autoload.php');

use DP\FizzBuzz;
use DP\FizzBuzz\Rule;

//rules can be passed to a ruleset by a constructor
$ruleset = new FizzBuzz\Ruleset(new Rule\Fizz(), new Rule\Buzz());
//or by the add method
$ruleset->add(new Rule\FizzBuzz());

//each game must have a ruleset provided
$game = new FizzBuzz\Game($ruleset);
//game starts by counting to defined limit
$result = $game->countTo(100);

//result of the game can be printed in preferred way
echo 'Game result: <pre>' . print_r($result, true) . '</pre>';
