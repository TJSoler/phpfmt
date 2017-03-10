<?php

require __DIR__.'/../vendor/autoload.php';

// we create a new instance of BaseCodeFormatter
// only because I don't want to instantiate or 
// copy / paste all the constants we need.
$removeFromHerePlease =new Fmt\BaseCodeFormatter;

// we probably need to find a better way to
// accomplish this.