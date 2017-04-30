<?php

namespace Fmt\Tests\Unit\AlignDoubleSlashComments;

use Fmt\Fixers\AlignDoubleSlashComments;
use Fmt\Tests\Unit\Fixers\FixerUnitTestCase;

class AlignDoubleSlashCommentsTest extends FixerUnitTestCase
{
    public function testCandidate()
    {
        $sourceTrue = $this->getSource(__DIR__ . DIRECTORY_SEPARATOR . 'wrong.php');
        $tokensSourceTrue = $this->getTokens($sourceTrue);

        $class = new AlignDoubleSlashComments;

        $this->assertTrue($class->candidate($sourceTrue, $tokensSourceTrue[0]));
    }

    public function testFormat()
    {
        $source = $this->getSource(__DIR__ . '/wrong.php');
        $expected = $this->getSource(__DIR__ . '/expected.php');

        $class = new AlignDoubleSlashComments;

        $fixedSource = $class->format($source);

        $this->assertFalse(strcmp($source, $expected) === 0);
        $this->assertTrue(strcmp($fixedSource, $expected) === 0);
    }
}
