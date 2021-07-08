<?php

declare(strict_types=1);

namespace DP\FizzBuzz;

use DP\FizzBuzz\Rule\Fizz;
use DP\FizzBuzz\Rule\FizzBuzz;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use ReflectionClass;
use TypeError;
use stdClass;

/**
 * Class RulesetTest
 * @package DP\FizzBuzz
 * @group Core
 */
final class RulesetTest extends TestCase
{
    /** @var Fizz Stub for a test object. */
    private Fizz $fizzStub;

    /** @var FizzBuzz Stub for a test object. */
    private FizzBuzz $fizzBuzzStub;

    /**
     * Setup of stubs for a test object.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->fizzStub = $this->createStub(Fizz::class);
        $this->fizzBuzzStub = $this->createStub(FizzBuzz::class);
    }

    /**
     * Rule can be added by constructor.
     *
     * @return Ruleset
     */
    public function testRuleCanBeAddedByConstructor(): Ruleset
    {
        $ruleset = new Ruleset($this->fizzStub);
        $this->assertCount(1, $ruleset);
        return $ruleset;
    }

    /**
     * Rule can be added by method: add.
     *
     * @depends testRuleCanBeAddedByConstructor
     * @param Ruleset $ruleset
     * @return Ruleset
     */
    public function testRuleCanBeAddedByMethodAdd(Ruleset $ruleset): Ruleset
    {
        $ruleset->add($this->fizzBuzzStub);
        $this->assertCount(2, $ruleset);
        return $ruleset;
    }

    /**
     * Rule can be overridden by method: add.
     *
     * @depends testRuleCanBeAddedByMethodAdd
     * @param Ruleset $ruleset
     * @return void
     */
    public function testRuleCanBeOverriddenByMethodAdd(Ruleset $ruleset): void
    {
        $ruleset->add($this->fizzStub);
        $this->assertCount(2, $ruleset);
    }

    /**
     * Rule can be added only by polymorphism.
     *
     * @depends testRuleCanBeAddedByMethodAdd
     * @param Ruleset $ruleset
     * @return void
     */
    public function testRuleCanBeAddedOnlyByPolymorphism(Ruleset $ruleset): void
    {
        $this->expectException(TypeError::class);
        /** @noinspection PhpParamsInspection */
        $ruleset->add(new stdClass());
    }

    /**
     * Rules are sorted from most to least complex.
     *
     * @depends testRuleCanBeAddedByMethodAdd
     * @param Ruleset $ruleset
     * @return Ruleset
     * @throws ReflectionException
     */
    public function testRulesAreSortedFromMostToLeastComplex(Ruleset $ruleset): Ruleset
    {
        $ruleset->sort();
        $property = (new ReflectionClass(Ruleset::class))->getProperty('rules');
        $property->setAccessible(true);
        $names = array_keys($property->getValue($ruleset));

        $this->assertCount(2, $names);
        $this->assertGreaterThanOrEqual(strlen($names[1]), strlen($names[0]));
        return $ruleset;
    }

    /**
     * Process returns number if no rule applied.
     * @return void
     */
    public function testProcessReturnsNumberIfNoRuleApplied(): void
    {
        $this->fizzStub->method('check')->willReturn(false);
        $this->fizzBuzzStub->method('check')->willReturn(false);
        $result = (new Ruleset($this->fizzStub, $this->fizzBuzzStub))->process(10);

        $this->assertEquals(10, $result);
    }

    /**
     * Process returns rule name if rule applied.
     * @return void
     */
    public function testProcessReturnsRuleNameIfRuleApplied(): void
    {
        $this->fizzStub->method('check')->willReturn(false);
        $this->fizzBuzzStub->method('check')->willReturn(true);
        $result = (new Ruleset($this->fizzStub, $this->fizzBuzzStub))->process(15);

        $this->assertSame(get_class($this->fizzBuzzStub), $result);
    }
}
