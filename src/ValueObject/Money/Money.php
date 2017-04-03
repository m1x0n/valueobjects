<?php

namespace EventSourced\ValueObject\ValueObject\Money;

use EventSourced\ValueObject\Contracts\ValueObject;
use EventSourced\ValueObject\Contracts\ValueObject\Money as MoneyContract;
use EventSourced\ValueObject\ValueObject\Type\AbstractComposite;
use Money\Currency;

final class Money extends AbstractComposite implements MoneyContract
{
    protected $amount;
    protected $currency;

    public function __construct(Amount $amount, CurrencyCode $currency)
    {
        $money = new \Money\Money(
            $amount->value(),
            new \Money\Currency($currency->value())
        );

        $this->amount = new Amount($money->getAmount());
        $this->currency = new CurrencyCode($money->getCurrency()->getCode());
    }

    private function toInternal(MoneyContract $money)
    {
        return new \Money\Money(
            $money->getAmount()->value(),
            new Currency($money->getCurrency()->value())
        );
    }

    private function toExternal(\Money\Money $money)
    {
        return new self(
            new Amount($money->getAmount()),
            new CurrencyCode($money->getCurrency()->getCode())
        );
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function add(MoneyContract $addend)
    {
        $current = $this->toInternal($this);
        $addend  = $this->toInternal($addend);
        $result = $current->add($addend);

        return $this->toExternal($result);
    }

    public function subtract(MoneyContract $subtrahend)
    {
        $current = $this->toInternal($this);
        $subtrahend  = $this->toInternal($subtrahend);
        $result = $current->subtract($subtrahend);

        return $this->toExternal($result);
    }

    public function multiply($multiplier, $roundingMode)
    {
        $current = $this->toInternal($this);
        $result = $current->multiply($multiplier->value(), $roundingMode);

        return $this->toExternal($result);
    }

    public function divide($divisor, $roundingMode)
    {
        $current = $this->toInternal($this);
        $result = $current->divide($divisor->value(), $roundingMode);

        return $this->toExternal($result);
    }

    public function absolute()
    {
        $current = $this->toInternal($this);
        $result = $current->absolute();

        return $this->toExternal($result);
    }

    public function compare(MoneyContract $other)
    {
        $current = $this->toInternal($this);
        $other = $this->toInternal($other);

        return $current->compare($other);
    }

    public function isPositive()
    {
        return $this->toInternal($this)->isPositive();
    }

    public function isNegative()
    {
        return $this->toInternal($this)->isNegative();
    }

    public function isZero()
    {
        return $this->toInternal($this)->isZero();
    }

    public function isSameCurrency(MoneyContract $other)
    {
        $current = $this->toInternal($this);
        $other = $this->toInternal($other);

        return $current->isSameCurrency($other);
    }

    public function lessThan(MoneyContract $other)
    {
        $current = $this->toInternal($this);
        $other = $this->toInternal($other);

        return $current->lessThan($other);
    }

    public function lessThanOrEqual(MoneyContract $other)
    {
        $current = $this->toInternal($this);
        $other = $this->toInternal($other);

        return $current->lessThanOrEqual($other);
    }

    public function greaterThan(MoneyContract $other)
    {
        $current = $this->toInternal($this);
        $other = $this->toInternal($other);

        return $current->greaterThan($other);
    }

    public function greaterThanOrEqual(MoneyContract $other)
    {
        $current = $this->toInternal($this);
        $other = $this->toInternal($other);

        return $current->greaterThanOrEqual($other);
    }

    public function equals(ValueObject $other_valueobject)
    {
        return $this->isSameCurrency($other_valueobject) &&
            $this->amount->equals($other_valueobject->getAmount());
    }
}
