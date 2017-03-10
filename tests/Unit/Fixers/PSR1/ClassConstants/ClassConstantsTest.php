<?php

namespace Fmt\Tests\Unit\PSR1\ClassConstants;

use Fmt\Fixers\PSR1\ClassConstants;
use Fmt\Tests\Unit\Fixers\FixerUnitTestCase;

class ClassConstantsTest extends FixerUnitTestCase
{
    public function testCandidate()
    {
        $sourceTrue = $this->getSource(__DIR__ . '/fileWithConstants.php');
        $sourceFalse = $this->getSource(__DIR__ . '/fileWithoutConstants.php');
       
        $tokensSourceTrue = $this->getTokens($sourceTrue);
        $tokensSourceFalse = $this->getTokens($sourceFalse);

        $class = new ClassConstants;
        
        $this->assertTrue($class->candidate($sourceTrue, $tokensSourceTrue[0]));
        $this->assertFalse($class->candidate($sourceFalse, $tokensSourceFalse[0]));
    }

    public function testFormat()
    {
        $source = $this->getSource(__DIR__ . '/fileWithConstants.php');
        $expected = $this->getSource(__DIR__ . '/expectedResult.php');

        $class = new ClassConstants;
        $fixedSource = $class->format($source);

        $this->assertFalse(strcmp($source, $expected) === 0);
        $this->assertTrue(strcmp($fixedSource, $expected) === 0);
    }
}
