<?php
namespace OCFram;
use OCFram\Validator;

/**
 *
 */
class NotNullValidator extends Validator
{

    function isValid(String $value): bool
    {
        return $value != '';
    }
}
