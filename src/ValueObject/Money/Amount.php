<?php

namespace EventSourced\ValueObject\ValueObject\Money;

use EventSourced\ValueObject\ValueObject\Type\AbstractSingleValue;

class Amount extends AbstractSingleValue
{
    protected function validator()
    {
        return parent::validator()->notOptional();
    }
}
