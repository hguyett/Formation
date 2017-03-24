<?php
class NotFoundException extends Exception {
    public function __construct()
    {
        parent::__construct('Requested data was not found.', 404);
    }
}
