<?php

namespace Fmt\Tests\Unit\PSR2\KeywordsLowerCase;

use Fmt\Fixers\PSR2\KeywordsLowerCase;
use Fmt\Tests\Unit\Fixers\FixerUnitTestCase;

class KeywordsLowerCaseTest extends FixerUnitTestCase
{
    public function testCandidate()
    {
        $sourceTrue = $this->getSource(__DIR__ . DIRECTORY_SEPARATOR . 'wrong.php');
        $tokensSourceTrue = $this->getTokens($sourceTrue);
        $class = new KeywordsLowerCase;
        
        $this->assertTrue($class->candidate($sourceTrue, null));
    }

    public function testFormat()
    {
        $source = $this->getSource(__DIR__ . '/wrong.php');
        $expected = $this->getSource(__DIR__ . '/expected.php');

        $class = new KeywordsLowerCase;

        $fixedSource = $class->format($source);

        $this->assertFalse(strcmp($source, $expected) === 0);
        $this->assertTrue(strcmp($fixedSource, $expected) === 0);
    }
}
