<?php

namespace Fmt\Fixers\PSR1;

use Fmt\FormatterPass;
use Fmt\Fixers\FixerInterface;

/**
 * Method names MUST be declared in camelCase.
 */
class MethodNames extends FormatterPass implements FixerInterface
{
    public function candidate($source, $foundTokens)
    {
        if (isset($foundTokens[T_FUNCTION])) {
            return true;
        }
        return false;
    }

    public function format($source)
    {
        $this->tkns = token_get_all($source);
        $this->code = '';
        
        $foundMethod = false;
        $methodReplaceList = [];

        while (list($index, $token) = each($this->tkns)) {
            list($id, $text) = $this->getToken($token);
            $this->ptr = $index;
            switch ($id) {
                case T_FUNCTION:
                    $foundMethod = true;
                    $this->appendCode($text);
                    break;
                case T_STRING:
                    if ($foundMethod) {
                        $count = 0;
                        $origText = $text;
                        $tmp = ucwords(str_replace(['-', '_'], ' ', strtolower($text), $count));
                        if ($count > 0 && '' !== trim($tmp) && '_' !== substr($text, 0, 1)) {
                            $text = lcfirst(str_replace(' ', '', $tmp));
                        }
                        $methodReplaceList[$origText] = $text;
                        $this->appendCode($text);
                        $foundMethod = false;
                        break;
                    }
                case '(':
                    $foundMethod = false;
                default:
                    $this->appendCode($text);
                    break;
            }
        }
        
        $this->tkns = token_get_all($this->code);
        $this->code = '';
        while (list($index, $token) = each($this->tkns)) {
            list($id, $text) = $this->getToken($token);
            $this->ptr = $index;
            switch ($id) {
                case T_STRING:
                    if (isset($methodReplaceList[$text]) && $this->rightUsefulTokenIs('(')) {
                        $this->appendCode($methodReplaceList[$text]);
                        break;
                    }
                default:
                    $this->appendCode($text);
                    break;
            }
        }
        return $this->code;
    }
}