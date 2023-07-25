<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Traits;

use Illuminate\Http\Request;
use Dclaysmith\LaravelPlaybooks\Exceptions\InvalidFilter;

trait AppliesFilters
{
    public function applyFilters(
        &$builder,
        Request $request,
        $availableFilters = []
    ) {
        $filters = array_unique($request->input("q", []));

        $properties = array_column($availableFilters, "property");

        foreach ($filters as $filter) {
            $matches = [];
            $pattern = '/^(.*?)\[([^\]]+)\](?:\=(.*?))?$/';

            if (preg_match($pattern, $filter, $matches)) {
                $property = $matches[1];
                $comparator = $matches[2];
                $value = \Arr::get($matches, 3); // raw =2 or =2,3,4  or possibly no value

                // Make sure it is an allowed property
                if (!in_array($property, $properties)) {
                    throw new InvalidFilter(
                        "Invalid filter property: " .
                            $property .
                            " Allowed ( " .
                            implode(", ", $properties) .
                            " )",
                        0 // RETURN A USEFUL CODE HERE
                    );
                }

                // Get the filter class using the property name (ex. type_id)
                $filterObject = \Arr::first($availableFilters, function (
                    $availableFilter,
                    $key
                ) use ($property) {
                    return $availableFilter->property == $property;
                });

                $valueFormatted = $filterObject->formatValue(
                    $comparator,
                    $value
                );

                // Is the comparator available
                if (!in_array($comparator, $filterObject->operators)) {
                    throw new InvalidFilter(
                        "Invalid filter operator: " .
                            $comparator .
                            " Allowed( " .
                            implode(",", $filterObject->operators) .
                            " )",
                        0 // RETURN A USEFUL CODE HERE
                    );
                }

                // Are the options limited
                if ("null" !== $comparator) {
                    if ($options = object_get($filterObject, "options")) {
                        if (is_array($valueFormatted)) {
                            // Are any of the provided values NOT in the list of valid options
                            $invalidValues = array_diff(
                                $valueFormatted,
                                $options
                            );
                            if (count($invalidValues)) {
                                throw new InvalidFilter(
                                    "Invalid filter value: " .
                                        implode(", ", $invalidValues),
                                    0 // RETURN A USEFUL CODE HERE
                                );
                            }
                        } elseif (!in_array($valueFormatted, $options)) {
                            throw new InvalidFilter(
                                "Invalid filter value: " .
                                    $valueFormatted .
                                    " Allowed( " .
                                    implode(", ", $options) .
                                    " )",
                                0 // RETURN A USEFUL CODE HERE
                            );
                        }
                    }
                }

                $filterObject->apply($builder, $comparator, $valueFormatted);
            }
        }
    }
}
