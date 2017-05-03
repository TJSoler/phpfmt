<?php

namespace Fmt\Console;

use Fmt\Console\Commands\FixCommand;
use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    const VERSION = '20.0.0-DEV';

    public function __construct()
    {
        parent::__construct('PHPFMT', self::VERSION);

        $this->add(new FixCommand());
        $this->setDefaultCommand(' ', true);

        // is there a way to show the help if no arguments are found?
    }

    public function getLongVersion()
    {
        $version = parent::getLongVersion().' created by <comment>U Cirello</comment>, rescued by <comment>David Nanch</comment> and maintained by <comment>Tomás Soler</comment>';
        $commit = '@git-commit@';
        if ('@'.'git-commit@' !== $commit) {
            $version .= ' ('.substr($commit, 0, 7).')';
        }

        return $version;
    }
}
