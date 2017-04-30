<?php

namespace Fmt\Fixers;

use Fmt\FormatterPass;
use Fmt\LeftAlignComment;
use Fmt\Fixers\FixerInterface;

/**
 * Strip empty lines after class opening curly brace.
 */
class StripNewlineWithinClassBody extends FormatterPass implements FixerInterface
{
    
    public function candidate($source, $foundTokens)
    {
        if (isset($foundTokens[T_CLASS]) || isset($foundTokens[T_TRAIT])) {
            return true;
        }

        return false;
    }

    public function format($source)
    {
        $this->tkns = token_get_all($source);
        $this->code = '';
        while (list($index, $token) = each($this->tkns)) {
            list($id, $text) = $this->getToken($token);
            $this->ptr = $index;
            switch ($id) {
                case T_TRAIT:
                case T_CLASS:
                    if ($this->leftUsefulTokenIs(T_DOUBLE_COLON)) {
                        $this->appendCode($text);
                        break;
                    }
                    $this->appendCode($text);
                    $this->printUntil(ST_CURLY_OPEN);
                    list(, $text) = $this->printAndStopAt(T_WHITESPACE);
                    if ($this->hasLn($text)) {
                        $text = substr(strrchr($text, 10), 0);
                    }
                    $this->appendCode($text);

                    $count = 1;
                    $block = '';
                    while (list($index, $token) = each($this->tkns)) {
                        list($id, $text) = $this->getToken($token);

                        if (ST_CURLY_OPEN == $id) {
                            ++$count;
                        }
                        if (T_CURLY_OPEN == $id) {
                            ++$count;
                        }
                        if (T_DOLLAR_OPEN_CURLY_BRACES == $id) {
                            ++$count;
                        }
                        if (ST_CURLY_CLOSE == $id) {
                            --$count;
                        }
                        if (0 == $count) {
                            break;
                        }
                        $block .= $text;
                    }
                    $this->appendCode($block);
                    $this->rtrimAndAppendCode($this->newLine.'}');
                    break;

                default:
                    $this->appendCode($text);
                    break;
            }
        }

        return $this->code;
    }
}
