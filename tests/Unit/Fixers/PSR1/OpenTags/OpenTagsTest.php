<?php

// this test won't work on php 7+ because every
// non standard tag is completely removed.

// namespace Fmt\Tests\Unit\PSR1\OpenTags;

// use Fmt\Fixers\PSR1\OpenTags;
// use Fmt\Tests\Unit\Fixers\FixerUnitTestCase;

// class OpenTagsTest extends FixerUnitTestCase
// {
//     public function testCandidate()
//     {
//         $sourceTrue = $this->getSource(__DIR__ . DIRECTORY_SEPARATOR . 'wrong.php');
//         $sourceFalse = $this->getSource(__DIR__ . DIRECTORY_SEPARATOR . 'expected.php');

//         $tokensSourceTrue = $this->getTokens($sourceTrue);
//         $tokensSourceFalse = $this->getTokens($sourceFalse);

//         $class = new OpenTags;
        
//         $this->assertTrue($class->candidate($sourceTrue, null));
//         $this->assertFalse($class->candidate($sourceFalse, null));
//     }

//     public function testFormat()
//     {
//         $source = $this->getSource(__DIR__ . '/wrong.php');
//         $expected = $this->getSource(__DIR__ . '/expected.php');

//         $class = new OpenTags;
//         $fixedSource = $class->format($source);
//         dd($fixedSource);
//         $this->assertFalse(strcmp($source, $expected) === 0);
//         $this->assertTrue(strcmp($fixedSource, $expected) === 0);
//     }
// }
