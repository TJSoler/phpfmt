<?php

namespace Fmt\Tests\Unit\Fixers;

use PHPUnit\Framework\TestCase;

class FixerUnitTestCase extends TestCase
{

    protected function getSource($file)
    {
        return file_get_contents($file);
    }

    protected function getToken($token)
    {
        $ret = [$token, $token];
        if (isset($token[1])) {
            $ret = $token;
        }

        return $ret;
    }

    protected function getTokens($source)
    {
        $foundTokens = [];
        $commentStack = [];
        $tkns = token_get_all($source);
        foreach ($tkns as $token) {
            list($id, $text) = $this->getToken($token);
            $foundTokens[$id] = $id;
            if (T_COMMENT === $id) {
                $commentStack[] = [$id, $text];
            }
        }

        return [$foundTokens, $commentStack];
    }
}
