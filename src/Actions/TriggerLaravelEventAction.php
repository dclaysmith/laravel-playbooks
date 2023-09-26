<?php

namespace Dclaysmith\LaravelPlaybooks\Actions;

use Illuminate\Support\Facades\Log;
use Dclaysmith\LaravelPlaybooks\Actions\Action;

class TriggerLaravelEventAction extends Action
{
    public function do(): void
    {
        Log::debug("do trigger event");
    }

    public static function definition(): array
    {
        return [
            [
                "key" => "event",
                "type" => "select",
                "label" => "Event",
                "options" => self::events(),
                "attributes" => [
                    "required" => true,
                ],
            ],
        ];
    }

    public static function events(): array
    {
        $eventsDirectory = config("laravel-playbooks.events_directory");

        if (!file_exists($eventsDirectory)) {
            return [];
        }

        $items = [];
        foreach (new \DirectoryIterator($eventsDirectory) as $file) {
            if ($file->isFile()) {
                $className = str_replace(".php", "", $file->getFilename());
                $namespaced =
                    config("laravel-playbooks.events_namespace") .
                    "\\" .
                    $className;
                $items[] = (object) [
                    "value" => $namespaced,
                    "label" => str_replace(".php", "", $file->getFilename()),
                ];
            }
        }

        return $items;
    }
}
