<?php

namespace Fmt\Tests\Unit\PSR2\SingleEmptyLineAndStripClosingTag;

use Fmt\Fixers\PSR2\SingleEmptyLineAndStripClosingTag;
use Fmt\Tests\Unit\Fixers\FixerUnitTestCase;

class SingleEmptyLineAndStripClosingTagTest extends FixerUnitTestCase
{
    public function testCandidate()
    {
        $sourceTrue = $this->getSource(__DIR__ . DIRECTORY_SEPARATOR . 'wrong.php');
        $tokensSourceTrue = $this->getTokens($sourceTrue);

        $class = new SingleEmptyLineAndStripClosingTag;

        $this->assertTrue($class->candidate($sourceTrue, $tokensSourceTrue[0]));
    }

    public function testFormat()
    {
        $source = $this->getSource(__DIR__ . '/wrong.php');
        $expected = $this->getSource(__DIR__ . '/expected.php');

        $class = new SingleEmptyLineAndStripClosingTag;

        $fixedSource = $class->format($source);

        $this->assertFalse(strcmp($source, $expected) === 0);
        $this->assertTrue(strcmp($fixedSource, $expected) === 0);
    }
}
