<?php

namespace Fmt;

final class CodeFormatter extends BaseCodeFormatter
{
    public function formatFile($file)
    {
        $file = BASEPATH.$file;

        // should we set output to the same file here?
        $this->formatCode(file_get_contents($file));
    }

    // public function afterExecutedPass($source, $className)
    // {
    //     $cn = get_class($className);
    //     echo $cn, PHP_EOL;
    //     echo $source, PHP_EOL;
    //     echo $cn, PHP_EOL;
    //     echo '----', PHP_EOL;
    //     if ('step' == getenv('FMTDEBUG')) {
    //         readline();
    //     }
    // }
}
