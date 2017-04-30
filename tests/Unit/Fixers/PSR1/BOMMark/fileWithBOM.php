<?php 

namespace Test\File;

class ExampleClass extends Nothing {
    
    protected $something;
    
    public function __construct($something)
    {
        $this->something = $something;
    }
}
