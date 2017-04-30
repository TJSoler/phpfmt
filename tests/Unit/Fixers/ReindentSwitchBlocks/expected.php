<?php

namespace Qualified\Name;

class SomethingHere
{
    public function __construct()
    {
        switch ($variable) {
            case 'value':
                $this->doSomething($variable);
                break;
            default:
                $this->doDefaultThing($variable);
                break;
        }
    }
}
