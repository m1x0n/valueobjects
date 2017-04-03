<?php

namespace EventSourced\ValueObject\ValueObject\Money;

use EventSourced\ValueObject\ValueObject\Type\AbstractSingleValue;

final class CurrencyCode extends AbstractSingleValue
{
    protected function validator()
    {
        return parent::validator()->currencyCode();
    }
}
