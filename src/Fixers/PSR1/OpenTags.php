<?php

namespace Fmt\Fixers\PSR1;

use Fmt\Fixers\FixerInterface;
use Fmt\FormatterPass;

/**
 * Files MUST use only <?php and <?= tags.
 */
class OpenTags extends FormatterPass implements FixerInterface
{
    public function candidate($source, $tokens)
    {
        return true;
    }
    
    public function format($source)
    {
        $this->tkns = token_get_all($source);
        $this->code = '';
        $touchedComment = false;
        while (list($index, $token) = each($this->tkns)) {
            list($id, $text) = $this->getToken($token);
            $this->ptr = $index;
            switch ($id) {
                case T_OPEN_TAG:
                    if ('<?php' !== $text) {
                        $this->appendCode('<?php' . ($this->hasLnAfter() || $this->hasLn($text) || $this->rightUsefulTokenIs(T_NAMESPACE) ? $this->newLine : $this->getSpace()));
                        break;
                    }
                    $this->appendCode($text);
                    break;
                case T_CLOSE_TAG:
                    if (!$touchedComment && !$this->leftUsefulTokenIs([ST_SEMI_COLON, ST_COLON, ST_CURLY_CLOSE, ST_CURLY_OPEN])) {
                        $this->appendCode(ST_SEMI_COLON);
                    }
                    $touchedComment = false;
                    $this->appendCode($text);
                    break;
                case T_COMMENT:
                case T_DOC_COMMENT:
                    if (
                        $this->rightUsefulTokenIs([T_CLOSE_TAG]) &&
                        !$this->leftUsefulTokenIs([ST_SEMI_COLON]) &&
                        !$this->leftUsefulTokenIs([T_OPEN_TAG])
                    ) {
                        $touchedComment = true;
                        $this->rtrimAndappendCode(ST_SEMI_COLON . ' ');
                    }
                    $this->appendCode($text);
                    break;
                default:
                    $this->appendCode($text);
                    break;
            }
        }
        return $this->code;
    }
}
