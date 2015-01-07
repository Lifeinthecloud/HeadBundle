<?php

namespace Lifeinthecloud\HeadBundle\Exception;

use Symfony\Component\Form\Exception\ExceptionInterface;

class KeywordException extends \Exception implements ExceptionInterface {

    public function __construct ( $message=null, $code=0, $arg=array() )
    {
        parent::__construct($message, $code);
    }
}