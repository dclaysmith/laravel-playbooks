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
            [
                "key" => "mailable",
                "type" => "text",
                "label" => "Mailable",
                "options" => SendEmailAction::mailables(),
                "required" => true
            ],
            [
                "key" => "text",
                "type" => "text",
                "label" => "Text",
                "options" => SendEmailAction::mailables(),
                "required" => true
            ],
            [
                "key" => "textarea",
                "type" => "textarea",
                "label" => "Text Area",
                "required" => true
            ],
            [
                "key" => "select",
                "type" => "select",
                "label" => "Select Test",
                "required" => true,
                "options" => [ "a" => "A", "b" => "B", "c" =>"C" ]
            ],
            //[
            //  "key" => "radio",
            //     "type" => "radio",
            //     "label" => "Radio Test",
            //     "required" => true,
            //     "options" => [ "y" => "Yes", "n" => "No" ],
            // ],
            //[
            //  "key" => "checkbox",
            //     "type" => "checkbox",
            //     "label" => "Checkbox Test",
            //     "required" => true,
            //     "options" => [ "y" => "Yes", "n" => "No" ],
            // ]
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
