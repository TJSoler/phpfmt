<?php

namespace Fmt\Fixers\PSR1;

use Fmt\FormatterPass;
use Fmt\Fixers\FixerInterface;

/**
 * PHP code MUST use only UTF-8 without BOM.
 */
class BOMMark extends FormatterPass implements FixerInterface
{
    const BOM = "\xef\xbb\xbf";

    public function candidate($source, $foundTokens)
    {
        return substr($source, 0, 3) === self::BOM;
    }

    public function format($source)
    {
        return substr($source, 3);
    }
}
