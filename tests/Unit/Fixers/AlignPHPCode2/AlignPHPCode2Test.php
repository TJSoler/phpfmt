<?php

namespace Fmt\Tests\Unit\AlignPHPCode2;

use Fmt\Fixers\AlignPHPCode2;
use Fmt\Tests\Unit\Fixers\FixerUnitTestCase;

class AlignPHPCode2Test extends FixerUnitTestCase
{
    public function testCandidate()
    {
        $sourceTrue = $this->getSource(__DIR__ . DIRECTORY_SEPARATOR . 'wrong.php');
        $tokensSourceTrue = $this->getTokens($sourceTrue);

        $class = new AlignPHPCode2;

        $this->assertTrue($class->candidate($sourceTrue, $tokensSourceTrue[0]));
    }

    public function testFormat()
    {
        $source = $this->getSource(__DIR__ . '/wrong.php');
        $expected = $this->getSource(__DIR__ . '/expected.php');

        $class = new AlignPHPCode2;

        $fixedSource = $class->format($source);
        
        $this->assertFalse(strcmp($source, $expected) === 0);
        $this->assertTrue(strcmp($fixedSource, $expected) === 0);
    }
}
