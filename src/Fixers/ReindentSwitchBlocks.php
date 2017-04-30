<?php

namespace Fmt\Fixers;

use Fmt\FormatterPass;
use Fmt\Fixers\FixerInterface;

class ReindentSwitchBlocks extends FormatterPass implements FixerInterface
{
    public function __construct()
    {
        $this->indentChar = " ";
    }

    public function candidate($source, $foundTokens)
    {
        if (isset($foundTokens[T_SWITCH])) {
            return true;
        }

        return false;
    }

    public function format($source)
    {
        $this->tkns = token_get_all($source);
        $this->code = '';
        $touchedSwitch = false;
        $foundStack = [];

        while (list($index, $token) = each($this->tkns)) {
            list($id, $text) = $this->getToken($token);
            $this->ptr = $index;

            switch ($id) {
                case ST_COLON:
                    $this->appendCode($text);
                    $this->setIndent(+1);
                    break;
                
                case T_BREAK:
                    $this->appendCode($text);
                    $this->setIndent(-1);
                    break;

                case ST_QUOTE:
                    $this->appendCode($text);
                    $this->printUntilTheEndOfString();
                    break;

                case T_CLOSE_TAG:
                    $this->appendCode($text);
                    $this->printUntil(T_OPEN_TAG);
                    break;

                case T_START_HEREDOC:
                    $this->appendCode($text);
                    $this->printUntil(T_END_HEREDOC);
                    break;

                case T_CONSTANT_ENCAPSED_STRING:
                    $this->appendCode($text);
                    break;

                case T_SWITCH:
                    $touchedSwitch = true;
                    $this->appendCode($text);
                    break;

                case T_DOLLAR_OPEN_CURLY_BRACES:
                case T_CURLY_OPEN:
                case ST_CURLY_OPEN:
                    $indentToken = $id;
                    $this->appendCode($text);
                    if ($touchedSwitch) {
                        $touchedSwitch = false;
                        $indentToken   = T_SWITCH;
                        $this->setIndent(+1);
                    }
                    $foundStack[] = $indentToken;
                    break;

                case ST_CURLY_CLOSE:
                    $poppedID = array_pop($foundStack);
                    if (T_SWITCH === $poppedID) {
                        $this->setIndent(-1);
                    }
                    $this->appendCode($text);
                    break;

                default:
                    $hasLn = $this->hasLn($text);
                    if ($hasLn) {
                        $poppedID = end($foundStack);
                        if (T_SWITCH == $poppedID &&
                            $this->rightTokenIs(ST_CURLY_CLOSE)
                        ) {
                            $this->setIndent(-1);
                            $text = str_replace(
                                $this->newLine,
                                $this->newLine . $this->getIndent(),
                                $text
                            );
                            $this->setIndent(+1);
                        } else {
                            $text = str_replace(
                                $this->newLine,
                                $this->newLine . $this->getIndent(),
                                $text
                            );
                        }
                    }
                    
                    $this->appendCode($text);
                    break;
            }
        }
        return $this->code;
    }
}
