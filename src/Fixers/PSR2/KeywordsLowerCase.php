<?php

namespace Fmt\Fixers\PSR2;

use Fmt\FormatterPass;
use Fmt\Fixers\FixerInterface;

/**
 * PHP keywords MUST be in lower case.
 * The PHP constants true, false, and null MUST be in lower case.
 */
class KeywordsLowerCase extends FormatterPass implements FixerInterface
{
    private static $reservedWords = [
        '__halt_compiler',
        'abstract',
        'and',
        'array',
        'as',
        'break',
        'callable',
        'case',
        'catch',
        'class',
        'clone',
        'const',
        'continue',
        'declare',
        'default',
        'die',
        'do',
        'echo',
        'else',
        'elseif',
        'empty',
        'enddeclare',
        'endfor',
        'endforeach',
        'endif',
        'endswitch',
        'endwhile',
        'eval',
        'exit',
        'extends',
        'final',
        'for',
        'foreach',
        'function',
        'global',
        'goto',
        'if',
        'implements',
        'include',
        'include_once',
        'instanceof',
        'insteadof',
        'interface',
        'isset',
        'list',
        'namespace',
        'new',
        'or',
        'print',
        'private',
        'protected',
        'public',
        'require',
        'require_once',
        'return',
        'static',
        'switch',
        'throw',
        'trait',
        'try',
        'unset',
        'use',
        'var',
        'while',
        'xor',
        'true',
        'false',
        'null'
    ];
   
    public function candidate($source, $foundTokens)
    {
        return $value = str_contains($source, static::$reservedWords);
    }

    public function format($source)
    {
        $this->tkns = token_get_all($source);
        $this->code = '';
        while (list($index, $token) = each($this->tkns)) {
            list($id, $text) = $this->getToken($token);
            $this->ptr = $index;
            if (
                T_WHITESPACE == $id ||
                T_VARIABLE == $id ||
                T_INLINE_HTML == $id ||
                T_COMMENT == $id ||
                T_DOC_COMMENT == $id ||
                T_CONSTANT_ENCAPSED_STRING == $id
            ) {
                $this->appendCode($text);
                continue;
            }

            if (
                T_STRING == $id
                && $this->leftUsefulTokenIs([T_DOUBLE_COLON, T_OBJECT_OPERATOR])
            ) {
                $this->appendCode($text);
                continue;
            }

            if (T_START_HEREDOC == $id) {
                $this->appendCode($text);
                $this->printUntil(ST_SEMI_COLON);
                continue;
            }
            if (ST_QUOTE == $id) {
                $this->appendCode($text);
                $this->printUntilTheEndOfString();
                continue;
            }
            $lcText = strtolower($text);
            if (
                (
                    ('true' === $lcText || 'false' === $lcText || 'null' === $lcText) &&
                    !$this->leftUsefulTokenIs([
                        T_NS_SEPARATOR, T_AS, T_CLASS, T_EXTENDS, T_IMPLEMENTS, T_INSTANCEOF, T_INTERFACE, T_NEW, T_NS_SEPARATOR, T_PAAMAYIM_NEKUDOTAYIM, T_USE, T_TRAIT, T_INSTEADOF, T_CONST,
                    ]) &&
                    !$this->rightUsefulTokenIs([
                        T_NS_SEPARATOR, T_AS, T_CLASS, T_EXTENDS, T_IMPLEMENTS, T_INSTANCEOF, T_INTERFACE, T_NEW, T_NS_SEPARATOR, T_PAAMAYIM_NEKUDOTAYIM, T_USE, T_TRAIT, T_INSTEADOF, T_CONST,
                    ])
                ) ||
                in_array($lcText, static::$reservedWords)
            ) {
                $text = $lcText;
            }
            $this->appendCode($text);
        }

        return $this->code;
    }
}
