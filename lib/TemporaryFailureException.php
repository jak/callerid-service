<?php
if (!defined('CALLERID')) {
    // This check helps protect against security problems;
    // your code file can't be executed directly from the web.
    exit(1);
}

class TemporaryFailureException extends Exception
{   
    public function __construct($message = null) {
        parent::__construct($message);
    }
}

