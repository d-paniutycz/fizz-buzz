# FizzBuzz Game

### About the game
> Fizz buzz is a group word game for children to teach them about division. Players take turns to count incrementally, replacing any number divisible by three with the word "fizz", and any number divisible by five with the word "buzz".

source: [Wikipedia](https://en.wikipedia.org/wiki/Fizz_buzz)

### Game rules
> Players generally sit in a circle. The player designated to go first says the number "1", and the players then count upwards in turn. However, any number divisible by three is replaced by the word fizz and any number divisible by five by the word buzz. Numbers divisible by 15 become fizz buzz.

source: [Wikipedia](https://en.wikipedia.org/wiki/Fizz_buzz)

### Simple implementation
The simplest PHP implementation is based on a set of conditional statements in a loop. The result of each condition is sent directly to the output. The code may not be reused other than by including it in a file or by duplicating the code - which violates the [DRY](https://en.wikipedia.org/wiki/Don%27t_repeat_yourself) principle.

```PHP
for ($i = 1; $i <= 100; $i++) {
    if ($i % 15 == 0) {
        echo 'FizzBuzz<br/>';
    } elseif ($i % 5 == 0) {
        echo 'Buzz<br/>';
    } elseif ($i % 3 == 0) {
        echo 'Fizz<br/>';
    } else {
        echo $i . '<br/>';
    }
}
```

### Reusable implementation
Reusable code requires at least a function to be used. As of PHP8 we may also replace conditional statements with an match expression - to simplify the code. The result is no longer sent directly to the output buffer but stored in a result container, the programmer decides when, where and how to use the returned game result.

```PHP
function FizzBuzz(int $limit): array
{
    for ($i = 1; $i <= $limit; $i++) {
        $result[] = match (true) {
            $i % 15 === 0 => 'FizzBuzz',
            $i %  5 === 0 => 'Buzz',
            $i %  3 === 0 => 'Fizz',
            default => (string)$i
        };
    }

    return $result ?? [];
}

print_r(FizzBuzz(100));
```

But there is a problem - reusable code is meant to be reused, everytime we want to change the code by adding new rules, the game results in other places may not be the same as previously assumed. It leads to the errors we want to avoid.

### Variations of the game rules
> In some versions of the game, other divisibility rules such as 7 can be used instead. Another rule that may be used to complicate the game is where numbers containing a digit also trigger the corresponding rule (for instance, 52 would use the same rule for a number divisible by 5).

source: [Wikipedia](https://en.wikipedia.org/wiki/Fizz_buzz)

### SOLID implementation
[SOLID](https://en.wikipedia.org/wiki/SOLID) is a set of principles for a better code quality. Second principle states that the code should be open for extension and closed for modification. Adding a new rule to the game should have no consequences elsewhere, and the current code should be not modified directly. This implementation covers other principles asswell.

#### Architecture
The implementation consists of three related logic layers, each layer is responsible for one task and can be replaced or extended at will. The first layer is the `Game` class and is responsible for the game flow. The second layer is a `Ruleset` collection which is the manager, responsible for controlling all operations on provided rules. The third layer are the `Rule` classes where the logical check take place. Each game has single ruleset which may contain multiple rules. For extension and usage examples see the [examples](./examples) directory.

#### Standards
- PSR-12 Extended Coding Style Guide
- PSR-4 Autoloading Standard

**Requirements**
- Composer >=2.0
- PHP >=8.0

**Installation**\
Clone the GIT repository, change directory to fizz-buzz, install project dependencies.
```shell
git clone git@github.com:d-paniutycz/fizz-buzz.git
cd fizz-buzz
composer install
```

**Tests**\
Tests can be performed in a group of `Rules` or `Core` or all together by Composer script.
```shell
composer tests
```
