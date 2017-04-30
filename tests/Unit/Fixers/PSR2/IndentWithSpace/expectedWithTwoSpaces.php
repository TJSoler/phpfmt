<?php

namespace Qualified\Name;

abstract class SomethingHere {
  public $something = true;
  protected $isHere = false;
  private $nothing = null;
  private $testArray = array('an', 'array', 'here');

  public function __construct()
  {
    const Something = 'this is a const';

    switch ($this->testArray) {
      case 'an':
        // do nothing, because this is only a test class...
        break;

      default:
        // code...
        break;

      if ($this->testArray[1] == 'array') {
        die();
      } elseif ($this->testArray[1] != 'array') {
        echo 'something';
      } else {
        $this->something = clone $this->testArray;
      }
    }
  }
}
