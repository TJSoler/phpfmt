<?php

namespace Fmt\Tests\Unit\PSR1\ClassNames;

use Fmt\Fixers\PSR1\ClassNames;
use Fmt\Tests\Unit\Fixers\FixerUnitTestCase;

class ClassNamesTest extends FixerUnitTestCase
{
    public function testCandidate()
    {
        $sourceTrue = $this->getSource(__DIR__ . '/wrongClassName.php');
        $sourceFalse = $this->getSource(__DIR__ . '/fileWithoutAClass.php');
       
        $tokensSourceTrue = $this->getTokens($sourceTrue);
        $tokensSourceFalse = $this->getTokens($sourceFalse);

        $class = new ClassNames;
        
        $this->assertTrue($class->candidate($sourceTrue, $tokensSourceTrue[0]));
        $this->assertFalse($class->candidate($sourceFalse, $tokensSourceFalse[0]));
    }

    public function testFormat()
    {
        $source = $this->getSource(__DIR__ . '/wrongClassName.php');
        $expected = $this->getSource(__DIR__ . '/expectedResult.php');

        $class = new ClassNames;
        $fixedSource = $class->format($source);

        $this->assertFalse(strcmp($source, $expected) === 0);
        $this->assertTrue(strcmp($fixedSource, $expected) === 0);
    }
}
