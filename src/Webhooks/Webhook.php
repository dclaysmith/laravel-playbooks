<?php

namespace Dclaysmith\LaravelPlaybooks\Webhooks;

use Illuminate\Database\Eloquent\Model;

abstract class Webhooks
{

    protected $url;

    protected $headers;

    protected $callback;

    abstract function payload(Model $model): array;

    protected function send() {

        $options = [
            'http' => [
                'header' => array_unique(array_merge($this->headers, [
                    "Content-type: application/x-www-form-urlencoded",])),
                'method' => 'POST',
                'content' => http_build_query($this->payload()),
            ],
        ];
        
        $context = stream_context_create($options);

        $result = file_get_contents($this->url, false, $context);

        if ($result === false) {
            /* Handle error */
        }
        
        var_dump($result);
    }
}
