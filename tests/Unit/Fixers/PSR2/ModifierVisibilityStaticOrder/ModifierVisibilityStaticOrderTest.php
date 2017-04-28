<?php

namespace Fmt\Tests\Unit\PSR2\ModifierVisibilityStaticOrder;

use Fmt\Fixers\PSR2\ModifierVisibilityStaticOrder;
use Fmt\Tests\Unit\Fixers\FixerUnitTestCase;

class ModifierVisibilityStaticOrderTest extends FixerUnitTestCase
{
    public function testCandidate()
    {
        $sourceTrue = $this->getSource(__DIR__ . DIRECTORY_SEPARATOR . 'wrong.php');
        $tokensSourceTrue = $this->getTokens($sourceTrue);

        $class = new ModifierVisibilityStaticOrder;

        $this->assertTrue($class->candidate($sourceTrue, $tokensSourceTrue[0]));
    }

    public function testFormat()
    {
        $source = $this->getSource(__DIR__ . '/wrong.php');
        $expected = $this->getSource(__DIR__ . '/expected.php');

        $class = new ModifierVisibilityStaticOrder;

        $fixedSource = $class->format($source);

        $this->assertFalse(strcmp($source, $expected) === 0);
        $this->assertTrue(strcmp($fixedSource, $expected) === 0);
    }
}
