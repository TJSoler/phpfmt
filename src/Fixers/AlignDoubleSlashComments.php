<?php

namespace Fmt\Fixers;

use Fmt\FormatterPass;
use Fmt\LeftAlignComment;

class AlignDoubleSlashComments extends FormatterPass implements FixerInterface
{
    const ALIGNABLE_COMMENT = "\x2 COMMENT%d \x3";

    public function candidate($source, $foundTokens)
    {
        if (isset($foundTokens[T_COMMENT])) {
            return true;
        }

        return false;
    }

    public function format($source)
    {
        $this->tkns = token_get_all($source);
        $this->code = '';

        $contextCounter = 0;
        $touchedNonAlignableComment = false;

        while (list($index, $token) = each($this->tkns)) {
            list($id, $text) = $this->getToken($token);
            $this->ptr = $index;
            switch ($id) {
                case T_COMMENT:
                    if (LeftAlignComment::NON_INDENTABLE_COMMENT == $text) {
                        $touchedNonAlignableComment = true;
                        $this->appendCode($text);
                        continue;
                    }

                    $prefix = '';
                    if (substr($text, 0, 2) == '//' && ! $touchedNonAlignableComment) {
                        $prefix = sprintf(self::ALIGNABLE_COMMENT, $contextCounter);
                    }
                    $this->appendCode($prefix.$text);

                    break;

                case T_WHITESPACE:
                    if ($this->hasLn($text)) {
                        ++$contextCounter;
                    }
                    $this->appendCode($text);
                    break;

                default:
                    $touchedNonAlignableComment = false;
                    $this->appendCode($text);
                    break;
            }
        }

        $this->alignPlaceholders(self::ALIGNABLE_COMMENT, $contextCounter);

        return $this->code;
    }
}
