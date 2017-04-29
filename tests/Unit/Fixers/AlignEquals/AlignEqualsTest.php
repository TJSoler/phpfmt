<?php

namespace Fmt\Tests\Unit\AlignEquals;

use Fmt\Fixers\AlignEquals;
use Fmt\Tests\Unit\Fixers\FixerUnitTestCase;

class AlignEqualsTest extends FixerUnitTestCase
{
    public function testCandidate()
    {
        $sourceTrue = $this->getSource(__DIR__ . DIRECTORY_SEPARATOR . 'wrong.php');
        $tokensSourceTrue = $this->getTokens($sourceTrue);

        $class = new AlignEquals;

        $this->assertTrue($class->candidate($sourceTrue, $tokensSourceTrue[0]));
    }

    public function testFormat()
    {
        $source = $this->getSource(__DIR__ . '/wrong.php');
        $expected = $this->getSource(__DIR__ . '/expected.php');

        $class = new AlignEquals;

        $fixedSource = $class->format($source);

        $this->assertFalse(strcmp($source, $expected) === 0);
        $this->assertTrue(strcmp($fixedSource, $expected) === 0);
    }
}
