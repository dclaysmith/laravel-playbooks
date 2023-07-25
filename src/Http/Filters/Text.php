<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Filters;
use Dclaysmith\LaravelPlaybooks\Exceptions\InvalidFilter;

class Text extends Base
{
    public function apply(&$builder, $comparator, $value)
    {
        // Apply the filter
        switch ($comparator) {
            case Base::TYPE_EQUALS:
                $builder->where($this->property(), $value);
                break;
            case Base::TYPE_NOT_EQUALS:
                $builder->where(function ($query) use ($value) {
                    $query->where($this->property(), "!=", $value);
                    $query->orWhereNull($this->property());
                });
                break;
            case Base::TYPE_NULL:
                $builder->whereNull($this->property());
                break;
            case Base::TYPE_NOT_NULL:
                $builder->whereNotNull($this->property());
                break;
            case Base::TYPE_LIKE:
                $builder->where($this->property(), "ILIKE", "%" . $value . "%");
                break;
            case Base::TYPE_BEGINS_WITH:
                $builder->where($this->property(), "ILIKE", $value . "%");
                break;
            case Base::TYPE_ENDS_WITH:
                $builder->where($this->property(), "ILIKE", "%" . $value);
                break;
        }
    }
}
