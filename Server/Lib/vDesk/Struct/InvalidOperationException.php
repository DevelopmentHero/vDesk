<?php

namespace vDesk\Struct;

/**
 * Exception that is thrown when an invalid operation has been performed.
 *
 * @author  Kerry Holz <DevelopmentHero@gmail.com>
 * @version 1.0.0.
 */
class InvalidOperationException extends \Exception {

    /**
     * Initializes a new instance of the InvalidOperationException class.
     *
     * @param string          $message  Initializes the InvalidOperationException with the specified message.
     * @param int             $code     Initializes the InvalidOperationException with the specified code.
     * @param \Throwable|null $previous Initializes the InvalidOperationException with the specified previous occurred Exception.
     */
    public function __construct(string $message = "", int $code = 2, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}