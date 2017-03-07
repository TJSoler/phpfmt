<?php

namespace Fmt\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FixCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
        // $this->defaultConfig = new Config();
        // $this->errorsManager = new ErrorsManager();
        // $this->eventDispatcher = new EventDispatcher();
        // $this->stopwatch = new Stopwatch();
    }

    protected function configure()
    {
        $this
            ->setName('fix')
            ->setDefinition([
                // arguments
                new InputArgument(
                	'path',
                	InputArgument::REQUIRED | InputArgument::IS_ARRAY,
                	'The path or file.'
                ),

                // options
                new InputOption(
                	'cakephp',
                	'',
                	InputOption::VALUE_NONE,
                	'Apply CakePHP coding style'
                ),

                new InputOption(
                	'config',
                	'',
                	InputOption::VALUE_REQUIRED,
                	'The path to a configuration file',
                	'.phpfmt.ini'
                ),

                new InputOption(
                	'constructor',
                	'',
                	InputOption::VALUE_REQUIRED,
                	'Analyse classes for attributes and generate constructor. Options: camel, snake, golang',
                	'camel'
                ),

                new InputOption(
                	'dry-run',
                	'',
                	InputOption::VALUE_NONE,
                	'Only shows which files would have been modified.'
                ),

                new InputOption(
                	'enable_auto_align',
                	'',
                	InputOption::VALUE_NONE,
                	'Disable auto align of ST_EQUAL and T_DOUBLE_ARROW'
                ),

                new InputOption(
					'exclude',
					'',
					InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
					'Disable specific passes. Ex: --exlude=GeneratePHPDoc,LongArray'
				),

				new InputOption(
					'help-pass',
					'',
					InputOption::VALUE_REQUIRED,
					'Show specific information for a pass.'
				),

				new InputOption(
					'ignore',
					'',
					InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
					'Ignore file names whose names contain any of the patterns.'
				),

				new InputOption(
					'indent_with_space',
					'',
					InputOption::VALUE_REQUIRED,
					'Use spaces instead of tabs for indentation.',
					'4'
				),

				new InputOption(
					'lint-before',
					'',
					InputOption::VALUE_NONE,
					'Lint files before pretty printing (PHP must be declared in the PATH).'
				),

				new InputOption(
					'list',
					'',
					InputOption::VALUE_NONE,
					'List all possible transformations.'
				),

				new InputOption(
					'list-simple',
					'',
					InputOption::VALUE_NONE,
					'List all possible transformations (greppable).'
				),

				// '--no-backup' => 'no backup file (original.php~)',
				new InputOption(
					'no-backup',
					'',
					InputOption::VALUE_NONE,
					'No backup file. (something.php~)'
				),

				// '--passes=pass1,passN,...' => 'call specific compiler pass',
				new InputOption(
					'passes',
					'',
					InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
					'Call specific compiler pass. Ex --passes=OrderAndRemoveUseClauses'
				),

				// '--profile=NAME' => 'use one of profiles present in configuration file',
				new InputOption(
					'profile',
					'',
					InputOption::VALUE_REQUIRED,
					'Use one of profiles present in configuration file.'
				),
				
			    // '--psr' => 'activate PSR1 and PSR2 styles',
				new InputOption(
					'psr',
					'',
					InputOption::VALUE_NONE,
					'Activate PSR1 and PSR2 styles.'
				),
			    // '--psr1' => 'activate PSR1 style',
			    new InputOption(
			    	'psr1',
			    	'',
			    	InputOption::VALUE_NONE,
			    	'Activate PSR1 styles.'
			    ),
			    // '--psr1-naming' => 'activate PSR1 style - Section 3 and 4.3 - Class and method names case.',
			    new InputOption(
			    	'psr1-naming',
			    	'',
			    	InputOption::VALUE_NONE,
			    	'Activate PSR1 style - Section 3 and 4.3 - Class and method names case.'
			    ),
			    // '--psr2' => 'activate PSR2 style',
			    new InputOption(
			    	'psr2',
			    	'',
			    	InputOption::VALUE_NONE,
			    	'Activate PSR2 style.'
			    ),
			    // '--setters_and_getters=type' => 'analyse classes for attributes and generate setters and getters - camel, snake, golang',
			    new InputOption(
			    	'setters_and_getters',
			    	'',
			    	InputOption::VALUE_REQUIRED,
			    	'Analyze classes for attributes and generate setters and getters. Options: camel, snake, golang.'
			    ),
			    // '--smart_linebreak_after_curly' => 'convert multistatement blocks into multiline blocks',
			    new InputOption(
			    	'smart_linebreak_after_curly',
			    	'',
			    	InputOption::VALUE_NONE,
			    	'Convert multistatement blocks into multiline blocks.'
			    ),
			    // '--visibility_order' => 'fixes visibiliy order for method in classes - PSR-2 4.2',
			    new InputOption(
			    	'visibility_order',
			    	'',
			    	InputOption::VALUE_NONE,
			    	'Fixes visibiliy order for method in classes - PSR2 4.2.'
			    ), 
			    // '--yoda' => 'yoda-style comparisons',
			    new InputOption(
			    	'yoda',
			    	'',
			    	InputOption::VALUE_NONE,
			    	'Yoda style comparisons.'
			    ), 

			    // '-o=file' => 'output the formatted code to "file"',
			    // '-o=-' => 'output the formatted code to standard output',
			    New InputOption(
			    	'output',
			    	'o',
			    	InputOption::VALUE_REQUIRED,
			    	'Output the formatted code. Options: "filename" (a file), "-" (standard output)',
			    	'-'
			    ),
            ])
            ->setDescription('Fixes a directory or a file.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("<error>Not implemented</error>");
        return 1;
    }
}
