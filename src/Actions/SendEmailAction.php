<?php

namespace Dclaysmith\LaravelPlaybooks\Actions;

use Dclaysmith\LaravelPlaybooks\Actions\Action;

class SendEmailAction extends Action
{

    public function do(): void
    {
    }

    public static function definition(): object
    {
        return (object) [
            "mailable" => [
                "type" => "string",
                "label" => "Mailable",
                "options" => SendEmailAction::mailables(),
                "required" => true
            ]
        ];
    }

    public static function mailables(): array
    {
        $mailablesDirectory = config(
            "laravel-playbooks.mailables_directory"
        );

        if (!file_exists($mailablesDirectory)) {
            return [];
        }

        $mailables = [];
        foreach (new \DirectoryIterator($mailablesDirectory) as $file) {
            if ($file->isFile()) {
                $className = str_replace(".php", "", $file->getFilename());
                $namespaced = config(
                    "laravel-playbooks.mailables_namespace"
                ) . "\\" . $className;
                $mailables[] = (object) [
                    "className" => str_replace(".php", "", $file->getFilename()),
                    "namespace" => $namespaced,
                ];
            }
        }

        return $mailables;
    }
}
