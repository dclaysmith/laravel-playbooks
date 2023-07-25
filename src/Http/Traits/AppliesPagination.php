<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Traits;

use Illuminate\Http\Request;
use Dclaysmith\LaravelPlaybooks\Exceptions\InvalidPagination;

trait AppliesPagination
{
    public function applyPagination(
        &$builder,
        Request $request,
        $perPage = 25,
        $maxPerPage = 100
    ) {
        $pageSize = (int) $request->input("per_page", $perPage);

        if ($pageSize < 1) {
            throw new InvalidPagination(
                '\'per_page\' parameter must be greater than 0 or omitted. The default is ' .
                    $perPage .
                    ".",
                0 // RETURN A USEFUL CODE HERE
            );
        }

        if ($pageSize > $maxPerPage) {
            throw new InvalidPagination(
                "per_page parameter cannot be more than " . $maxPerPage . ".",
                0 // RETURN A USEFUL CODE HERE
            );
        }

        try {
            return $builder
                ->paginate($pageSize)
                ->appends($request->except("page"));
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
