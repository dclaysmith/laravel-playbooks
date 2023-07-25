<?php

namespace Dclaysmith\LaravelPlaybooks\Exceptions;

use Exception;

class InvalidFilter extends Exception
{
    public function __construct(
        $message = "",
        $code = 0,
        Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json(
            [
                "message" => $this->getMessage(),
                "code" => $this->getCode(),
            ],
            422
        );
    }
}
