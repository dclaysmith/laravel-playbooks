<?php

namespace Dclaysmith\LaravelPlaybooks\Actions;

use Illuminate\Support\Facades\Log;
use Dclaysmith\LaravelPlaybooks\Actions\Action;

class DispatchJobAction extends Action
{
    public function do(): void
    {
        Log::debug("do dispatch job");
    }

    public static function definition(): array
    {
        return [
            [
                "key" => "job",
                "type" => "select",
                "label" => "Job",
                "options" => self::jobs(),
                "attributes" => [
                    "required" => true,
                ],
            ],
        ];
    }

    public static function jobs(): array
    {
        $jobsDirectory = config("laravel-playbooks.jobs_directory");

        if (!file_exists($jobsDirectory)) {
            return [];
        }

        $items = [];
        foreach (new \DirectoryIterator($jobsDirectory) as $file) {
            if ($file->isFile()) {
                $className = str_replace(".php", "", $file->getFilename());
                $namespaced =
                    config("laravel-playbooks.jobs_namespace") .
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
