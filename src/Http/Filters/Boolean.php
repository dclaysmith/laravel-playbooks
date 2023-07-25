<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Filters;

use Dclaysmith\LaravelPlaybooks\Exceptions\InvalidFilter;

class Boolean extends Base
{
    public function apply(&$builder, $comparator, $value)
    {
        if (is_null($value) || "" === $value) {
            throw new InvalidFilter(
                "Null value provided: " . $value,
                0 // RETURN A USEFUL CODE HERE
            );
        }

        if (
            !in_array((string) $value, [
                "1",
                "0",
                "true",
                "false",
                "TRUE",
                "FALSE",
            ]) &&
            !is_bool($value)
        ) {
            throw new InvalidFilter(
                "Non boolean value provided: " . $value,
                0 // RETURN A USEFUL CODE HERE
            );
        }

        // Apply the filter
        switch ($comparator) {
            case Base::TYPE_EQUALS:
                $builder->where(
                    $this->property(),
                    filter_var($value, FILTER_VALIDATE_BOOLEAN)
                );
                break;
            case Base::TYPE_NOT_EQUALS:
                $builder->where(function ($query) use ($value) {
                    $query->where(
                        $this->property(),
                        "!=",
                        filter_var($value, FILTER_VALIDATE_BOOLEAN)
                    );
                    $query->orWhereNull($this->property());
                });
                break;
        }
    }
}
