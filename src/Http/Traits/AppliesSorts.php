<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Traits;

use Illuminate\Http\Request;
use Dclaysmith\LaravelPlaybooks\Exceptions\InvalidSort;

trait AppliesSorts
{
    public function applySorts(
        &$builder,
        Request $request,
        $available = [],
        $mappings = [],
        $default = []
    ) {
        $aSortBys = [];

        // Read the request into a string and split into an array
        if ($sortBys = $request->input("sort_by")) {
            $aSortBys = explode(",", $sortBys);
        }

        // If there is a default (sort by this after the others) append it
        if (count($default) > 0) {
            $aSortBys = array_merge($aSortBys, $default);
            $available = array_merge($available, $default);
        }

        // If there is no sorting just exit.
        if (count($aSortBys) === 0) {
            return;
        }

        foreach ($aSortBys as $sortBy) {
            $parts = explode(":", $sortBy);

            $property = \Arr::get($parts, 0);

            $direction = \Arr::get($parts, 1, "asc");

            if ($available && !in_array($property, $available)) {
                throw new InvalidSort(
                    "Invalid sort property: " .
                        $property .
                        ". Allowed ( " .
                        implode(", ", $available) .
                        " )",
                    0 // RETURN A USEFUL CODE HERE
                );
            }

            if (!in_array($direction, ["asc", "desc"])) {
                $direction = "asc";
            }

            if (array_key_exists($property, $mappings)) {
                foreach (\Arr::get($mappings, $property) as $mappedProperty) {
                    $builder->orderByRaw(
                        $mappedProperty . " " . $direction . " NULLS LAST"
                    );
                }
            } else {
                $builder->orderByRaw(
                    $property . " " . $direction . " NULLS LAST"
                );
            }
        }
    }
}
