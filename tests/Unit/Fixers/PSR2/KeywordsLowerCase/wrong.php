<?php

NAMESPACE Qualified\Name;

ABSTRACT CLASS SomethingHere {
    PUBLIC $something = TRUE;
    PROTECTED $isHere = FALSE;
    PRIVATE $nothing = NULL;
    PRIVATE $testArray = ARRAY('an', 'array', 'here');

    public FUNCTION __construct()
    {
        CONST Something = 'this is a const';

        SWITCH ($this->testArray) {
            CASE 'an':
                // do nothing, because this is only a test class...
                BREAK;
            
            DEFAULT:
                // code...
                break;

            IF ($this->testArray[1] == 'array') {
                DIE();
            } ELSEIF ($this->testArray[1] != 'array') {
                ECHO 'something';
            } ELSE {
                $this->something = CLONE $this->testArray;
            }
        }
    }
}