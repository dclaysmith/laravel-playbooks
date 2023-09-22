<?php

namespace Dclaysmith\LaravelPlaybooks\Actions;

use Illuminate\Support\Facades\Log;
use Dclaysmith\LaravelPlaybooks\Actions\Action;

class WaitForAction extends Action
{

    public function do(): void
    {
        Log::debug('do wait for');
    }

    public static function definition(): array
    {
        return [
            [
                "key" => "condition",
                "type" => "select",
                "label" => "Wait for condition to be met...",
                "options" => self::conditions(),
                "attributes" => [
                    "required" => true,
                ]
            ],
        ];
    }

    public static function conditions(): array
    {
        $conditionsDirectory = config(
            "laravel-playbooks.conditions_directory"
        );

        if (!file_exists($conditionsDirectory)) {
            return [];
        }

        $items = [];
        foreach (new \DirectoryIterator($conditionsDirectory) as $file) {
            if ($file->isFile()) {
                $className = str_replace(".php", "", $file->getFilename());
                $namespaced = config(
                    "laravel-playbooks.conditions_namespace"
                ) . "\\" . $className;
                $items[] = (object) [
                    "value" => $namespaced,
                    "label" => str_replace(".php", "", $file->getFilename())
                ];
            }
        }

        return $items;
    }
}
