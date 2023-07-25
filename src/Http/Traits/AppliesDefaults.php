<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Traits;

use Illuminate\Http\Request;

trait AppliesDefaults
{
    public function applyDefaults(&$data, $defaults = [])
    {
        foreach ($defaults as $index => $defaultValue) {
            if (!data_get($data, $index)) {
                $data[$index] = $defaultValue;
            }
        }
    }
}
