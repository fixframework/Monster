<?php

namespace Fix\Exception;

class Error extends \Exception
{

    /**
     * Error constructor.
     * @param null $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message = null, $code = 0, \Exception  $previous = null ) {

        parent::__construct($message, $code, $previous);

    }


    /**
     * @return string
     */
    public function toString() {

        return "[{$this->code}]: {$this->message}\n";

    }


    /**
     * @return string
     */
    public function toJson() {

        return json_encode(
            [
                "code" => $this->code,
                "message" => $this->message,
                "line" => $this->line,
                "file" => $this->file
            ]
        );

    }

}