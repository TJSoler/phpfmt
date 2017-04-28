<?php

namespace Fmt\Tests\Unit\PSR2\LnAfterNamespace;

use Fmt\Fixers\PSR2\LnAfterNamespace;
use Fmt\Tests\Unit\Fixers\FixerUnitTestCase;

class LnAfterNamespaceTest extends FixerUnitTestCase
{
    public function testCandidate()
    {
        $sourceTrue = $this->getSource(__DIR__ . DIRECTORY_SEPARATOR . 'wrong.php');
        $tokensSourceTrue = $this->getTokens($sourceTrue);

        $sourceFalse = $this->getSource(__DIR__ . DIRECTORY_SEPARATOR . 'withoutNamespace.php');
        $tokensSourceFalse = $this->getTokens($sourceFalse);

        $class = new LnAfterNamespace;

        $this->assertFalse($class->candidate($sourceFalse, $tokensSourceFalse[0]));
        $this->assertTrue($class->candidate($sourceTrue, $tokensSourceTrue[0]));
    }

    public function testFormat()
    {
        $source = $this->getSource(__DIR__ . '/wrong.php');
        $expected = $this->getSource(__DIR__ . '/expected.php');

        $class = new LnAfterNamespace;

        $fixedSource = $class->format($source);

        $this->assertFalse(strcmp($source, $expected) === 0);
        $this->assertTrue(strcmp($fixedSource, $expected) === 0);
    }
}
