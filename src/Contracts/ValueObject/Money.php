<?php

namespace EventSourced\ValueObject\Contracts\ValueObject;

use EventSourced\ValueObject\Contracts\ValueObject;

interface Money extends ValueObject
{
    public function getAmount();
    public function getCurrency();
    public function add(Money $addend);
    public function subtract(Money $subtrahend);
    public function multiply($multiplier, $roundingMode);
    public function divide($divisor, $roundingMode);
    public function absolute();
    public function isPositive();
    public function isNegative();
    public function isZero();
    public function isSameCurrency(Money $other);
    public function compare(Money $other);
    public function lessThan(Money $other);
    public function lessThanOrEqual(Money $other);
    public function greaterThan(Money $other);
    public function greaterThanOrEqual(Money $other);
}
