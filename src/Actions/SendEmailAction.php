<?php

namespace Dclaysmith\LaravelPlaybooks\Actions;

use Illuminate\Support\Facades\Log;
use Dclaysmith\LaravelPlaybooks\Actions\Action;

class SendEmailAction extends Action
{

    public function do(): void
    {
        Log::debug('do send email');
    }

    public static function definition(): array
    {
        return  [
            [
                "key" => "mailable",
                "type" => "select",
                "label" => "Mailable",
                "options" => SendEmailAction::mailables(),
                "attributes" => [
                    "required" => true,
                ]
            ],
            [
                "key" => "email",
                "type" => "text",
                "label" => "Email Attribute Name",
                "attributes" => [
                    "required" => true,
                ]
            ],
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
                    "value" => $namespaced,
                    "label" => str_replace(".php", "", $file->getFilename())
                ];
            }
        }

        return $mailables;
    }
}
