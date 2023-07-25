<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Filters;

use Dclaysmith\LaravelPlaybooks\Exceptions\InvalidFilter;

class Date extends Base
{
    public function apply(&$builder, $comparator, $value)
    {
        // Apply the filter
        switch ($comparator) {
            case Base::TYPE_NULL:
                $builder->whereNull($this->property());

                return;
                break;
            case Base::TYPE_NOT_NULL:
                $builder->whereNotNull($this->property());

                return;
                break;
        }

        if (is_null($value) || "" === $value) {
            throw new InvalidFilter(
                "Null value provided: " . $value,
                0 // RETURN A USEFUL CODE HERE
            );
        }

        $date = \DateTime::createFromFormat("Y-m-d", $value);
        if (!($date && $date->format("Y-m-d") === $value)) {
            throw new InvalidFilter(
                "Non date (YYYY-mm-dd) value provided: " . $value,
                0 // RETURN A USEFUL CODE HERE
            );
        }

        // Apply the filter
        switch ($comparator) {
            case Base::TYPE_EQUALS:
                $builder->whereDate($this->property(), "=", $date);
                break;
            case Base::TYPE_GREATER_THAN:
                $builder->whereDate($this->property(), ">", $date);
                break;
            case Base::TYPE_GREATER_THAN_EQUAL:
                $builder->whereDate($this->property(), ">=", $date);
                break;
            case Base::TYPE_LESS_THAN:
                $builder->whereDate($this->property(), "<", $date);
                break;
            case Base::TYPE_LESS_THAN_EQUAL:
                $builder->whereDate($this->property(), "<=", $date);
                break;
        }
    }
}
