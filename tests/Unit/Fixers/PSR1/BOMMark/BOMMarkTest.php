<?php

namespace Fmt\Tests\Unit\PSR1\BOMMark;

use Fmt\Fixers\PSR1\BOMMark;
use Fmt\Tests\Unit\Fixers\FixerUnitTestCase;

class BOMMarkTest extends FixerUnitTestCase
{
    public function testCandidate()
    {
        $sourceTrue = $this->getSource(__DIR__ . DIRECTORY_SEPARATOR . 'fileWithBOM.php');
        $sourceFalse = $this->getSource(__DIR__ . DIRECTORY_SEPARATOR . 'expectedResult.php');

        $class = new BOMMark;
        
        $this->assertTrue($class->candidate($sourceTrue, null));
        $this->assertFalse($class->candidate($sourceFalse, null));
    }

    public function testFormat()
    {
        $source = $this->getSource(__DIR__ . '/fileWithBOM.php');
        $expected = $this->getSource(__DIR__ . '/expectedResult.php');

        $class = new BOMMark;
        $fixedSource = $class->format($source);
        
        $this->assertFalse(strcmp($source, $expected) === 0);
        $this->assertTrue(strcmp($fixedSource, $expected) === 0);
    }
}
