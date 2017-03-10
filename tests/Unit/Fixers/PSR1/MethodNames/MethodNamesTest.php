<?php

namespace Fmt\Tests\Unit\Fixers\PSR1\MethodNames;

use Fmt\Fixers\PSR1\MethodNames;
use Fmt\Tests\Unit\Fixers\FixerUnitTestCase;

class MethodNamesTest extends FixerUnitTestCase
{
    public function testCandidate()
    {
        $sourceTrue = $this->getSource(__DIR__ . '/wrong.php');
        $sourceFalse = $this->getSource(__DIR__ . '/without.php');
       
        $tokensSourceTrue = $this->getTokens($sourceTrue);
        $tokensSourceFalse = $this->getTokens($sourceFalse);

        $class = new MethodNames;
        
        $this->assertTrue($class->candidate($sourceTrue, $tokensSourceTrue[0]));
        $this->assertFalse($class->candidate($sourceFalse, $tokensSourceFalse[0]));
    }

    public function testFormat()
    {
        $source = $this->getSource(__DIR__ . '/wrong.php');
        $expected = $this->getSource(__DIR__ . '/expected.php');

        $class = new MethodNames;
        $fixedSource = $class->format($source);

        $this->assertFalse(strcmp($source, $expected) === 0);
        $this->assertTrue(strcmp($fixedSource, $expected) === 0);
    }
}
