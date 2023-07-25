<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Filters;

use Illuminate\Http\Resources\Json\JsonResource;

abstract class Base
{
    const TYPE_EQUALS = "eq";

    const TYPE_NOT_EQUALS = "ne";

    const TYPE_GREATER_THAN = "gt";

    const TYPE_LESS_THAN = "lt";

    const TYPE_GREATER_THAN_EQUAL = "gte";

    const TYPE_LESS_THAN_EQUAL = "lte";

    const TYPE_LIKE = "like";

    const TYPE_NOT_LIKE = "notlike";

    const TYPE_BEGINS_WITH = "begins";

    const TYPE_ENDS_WITH = "ends";

    const TYPE_IN = "in";

    const TYPE_NOT_IN = "notin";

    const TYPE_NULL = "null";

    const TYPE_NOT_NULL = "notnull";

    public $property;

    public $fullProperty;

    public $operators;

    public $options;

    public function __construct(
        $property,
        $operators = [],
        $options = null,
        $fullProperty = null
    ) {
        // If there are ambiguous
        $this->property = $property;
        $this->operators = $operators;
        $this->options = $options;
        $this->fullProperty = $fullProperty;
    }

    abstract public function apply(&$builder, $comparator, $value);

    protected function property()
    {
        return $this->fullProperty ? $this->fullProperty : $this->property;
    }

    public function formatValue($comparator, $rawValue = null)
    {
        // Apply the filter
        switch ($comparator) {
            case self::TYPE_NULL:
            case self::TYPE_NOT_NULL:
                return null;
                break;
            case self::TYPE_EQUALS:
            case self::TYPE_NOT_EQUALS:
            case self::TYPE_GREATER_THAN:
            case self::TYPE_LESS_THAN:
            case self::TYPE_GREATER_THAN_EQUAL:
            case self::TYPE_LESS_THAN_EQUAL:
            case self::TYPE_LIKE:
            case self::TYPE_ENDS_WITH:
            case self::TYPE_BEGINS_WITH:
            case self::TYPE_NOT_LIKE:
                return $rawValue;
                break;
            case self::TYPE_IN:
            case self::TYPE_NOT_IN:
                return explode(",", $rawValue);
                break;
        }
    }
}
