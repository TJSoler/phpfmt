<?php

namespace Fmt\Tests\Unit\PSR2\IndentWithSpace;

use Fmt\Fixers\PSR2\IndentWithSpace;
use Fmt\Tests\Unit\Fixers\FixerUnitTestCase;

class IndentWithSpaceTest extends FixerUnitTestCase
{
    public function testCandidate()
    {
        $sourceTrue = $this->getSource(__DIR__ . DIRECTORY_SEPARATOR . 'wrong.php');
        $tokensSourceTrue = $this->getTokens($sourceTrue);
        $class = new IndentWithSpace;
        
        $this->assertTrue($class->candidate($sourceTrue, null));
    }

    public function testFormat()
    {
        $source = $this->getSource(__DIR__ . '/wrong.php');
        $expected = $this->getSource(__DIR__ . '/expected.php');
        $expectedWithTwoSpaces = $this->getSource(__DIR__ . '/expectedWithTwoSpaces.php');

        $class = new IndentWithSpace;
        $classWithTwoSpaces = new IndentWithSpace(2);

        $fixedSource = $class->format($source);
        $fixedSourceWithTwoSpaces = $classWithTwoSpaces->format($source);

        $this->assertFalse(strcmp($source, $expected) === 0);
        $this->assertTrue(strcmp($fixedSource, $expected) === 0);
        $this->assertTrue(strcmp($fixedSourceWithTwoSpaces, $expectedWithTwoSpaces) === 0);
    }
}
