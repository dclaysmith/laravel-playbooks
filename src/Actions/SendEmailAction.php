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
                "type" => "select",
                "label" => "Mailable",
                "options" => SendEmailAction::mailables(),
                "attributes" => [
                    "required" => true,
                ]
            ],
            // [
            //     "key" => "text",
            //     "type" => "text",
            //     "label" => "Text",
            //     "options" => SendEmailAction::mailables(),
            //     "required" => true
            // ],
            // [
            //     "key" => "textarea",
            //     "type" => "textarea",
            //     "label" => "Text Area",
            //     "required" => true
            // ],
            // [
            //     "key" => "radio",
            //     "type" => "radio",
            //     "label" => "Radio Test",
            //     "required" => true,
            //     "options" => [ "aaaa" => "Option 1", "bbbb" => "Option 2", "cccc" => "Option 3" ],
            // ],
            // [
            //     "key" => "checkbox",
            //     "type" => "checkbox",
            //     "label" => "Checkbox Test",
            //     "required" => true,
            //     "options" => [ "aaaaa" => "Yes", "bbbbb" => "No" ],
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
                    "value" => (object) [
                        "className" => str_replace(".php", "", $file->getFilename()),
                        "namespace" => $namespaced,
                    ],
                    "label" => str_replace(".php", "", $file->getFilename())
                ];
            }
        }
        
        return $mailables;
    }
}
