<?php

namespace Fmt;

use Fmt\Fixers\ReindentComments;
use Fmt\Fixers\AddMissingCurlyBraces;

abstract class BaseCodeFormatter
{
    protected $passes = [
        'StripSpaces' => false,

        'ReplaceBooleanAndOr' => false,
        'EliminateDuplicatedEmptyLines' => false,

        'RTrim' => false,
        'WordWrap' => false,

        'ConvertOpenTagWithEcho' => false,
        'RestoreComments' => false,
        'UpgradeToPreg' => false,
        'DocBlockToComment' => false,
        'LongArray' => false,

        'StripExtraCommaInArray' => false,
        'NoSpaceAfterPHPDocBlocks' => false,
        'RemoveUseLeadingSlash' => false,
        'ShortArray' => false,
        'MergeElseIf' => false,
        'SplitElseIf' => false,
        'AutoPreincrement' => false,
        'MildAutoPreincrement' => false,

        'CakePHPStyle' => false,

        'StripNewlineAfterClassOpen' => false,
        'StripNewlineAfterCurlyOpen' => false,

        'SortUseNameSpace' => false,
        'SpaceAroundExclamationMark' => false,
        'SpaceAroundParentheses' => false,

        'TightConcat' => false,

        'PSR2IndentWithSpace' => false,
        'AlignPHPCode' => false,
        'AlignPHPCode2' => false,
        'AllmanStyleBraces' => false,
        'NamespaceMergeWithOpenTag' => false,
        'MergeNamespaceWithOpenTag' => false,

        'LeftAlignComment' => false,

        'PSR2AlignObjOp' => false,
        'PSR2EmptyFunction' => false,
        'PSR2SingleEmptyLineAndStripClosingTag' => false,
        'PSR2ModifierVisibilityStaticOrder' => false,
        'PSR2CurlyOpenNextLine' => false,
        'PSR2LnAfterNamespace' => false,
        'PSR2KeywordsLowerCase' => false,

        'PSR1MethodNames' => false,
        'PSR1ClassNames' => false,

        'PSR1ClassConstants' => false,
        'PSR1BOMMark' => false,

        'EliminateDuplicatedEmptyLines' => false,
        'IndentTernaryConditions' => false,
        'ReindentComments' => false,
        'ReindentEqual' => false,
        'Reindent' => false,
        'ReindentAndAlignObjOps' => false,
        'ReindentObjOps' => false,

        'AlignDoubleSlashComments' => false,
        'AlignTypehint' => false,
        'AlignGroupDoubleArrow' => false,
        'AlignDoubleArrow' => false,
        'AlignEquals' => false,
        'AlignConstVisibilityEquals' => false,

        'ReindentSwitchBlocks' => false,
        'ReindentColonBlocks' => false,

        'SplitCurlyCloseAndTokens' => false,
        'ResizeSpaces' => false,

        'StripSpaceWithinControlStructures' => false,

        'StripExtraCommaInList' => false,
        'YodaComparisons' => false,

        'MergeDoubleArrowAndArray' => false,
        'MergeCurlyCloseAndDoWhile' => false,
        'MergeParenCloseWithCurlyOpen' => false,
        'NormalizeLnAndLtrimLines' => false,
        'ExtraCommaInArray' => false,
        'SmartLnAfterCurlyOpen' => false,
        'AddMissingCurlyBraces' => false,
        'OnlyOrderUseClauses' => false,
        'OrderAndRemoveUseClauses' => false,
        'AutoImportPass' => false,
        'ConstructorPass' => false,
        'SettersAndGettersPass' => false,
        'NormalizeIsNotEquals' => false,
        'RemoveIncludeParentheses' => false,
        'TwoCommandsInSameLine' => false,

        'SpaceBetweenMethods' => false,
        'GeneratePHPDoc' => false,
        'ReturnNull' => false,
        'AddMissingParentheses' => false,
        'WrongConstructorName' => false,
        'JoinToImplode' => false,
        'EncapsulateNamespaces' => false,
        'PrettyPrintDocBlocks' => false,
        'StrictBehavior' => false,
        'StrictComparison' => false,
        'ReplaceIsNull' => false,
        'DoubleToSingleQuote' => false,
        'LeftWordWrap' => false,
        'ClassToSelf' => false,
        'ClassToStatic' => false,
        'PSR2MultilineFunctionParams' => false,
        'SpaceAroundControlStructures' => false,

        'OrderMethodAndVisibility' => false,
        'OrderMethod' => false,
        'OrganizeClass' => false,
        'AutoSemicolon' => false,
        'PSR1OpenTags' => false,
        'PHPDocTypesToFunctionTypehint' => false,
        'RemoveSemicolonAfterCurly' => false,
        'NewLineBeforeReturn' => false,
        'EchoToPrint' => false,
        'TrimSpaceBeforeSemicolon' => false,
        'StripNewlineWithinClassBody' => false,
    ];

    private $hasAfterExecutedPass = false;

    private $hasAfterFormat = false;

    private $hasBeforeFormat = false;

    private $hasBeforePass = false;

    private $shortcircuit = [
        'AlignDoubleArrow' => ['AlignGroupDoubleArrow'],
        'AlignGroupDoubleArrow' => ['AlignDoubleArrow'],
        'AllmanStyleBraces' => ['PSR2CurlyOpenNextLine'],
        'OnlyOrderUseClauses' => ['OrderAndRemoveUseClauses'],
        'OrderAndRemoveUseClauses' => ['OnlyOrderUseClauses'],
        'OrganizeClass' => ['ReindentComments', 'RestoreComments'],
        'ReindentAndAlignObjOps' => ['ReindentObjOps'],
        'ReindentComments' => ['OrganizeClass', 'RestoreComments'],
        'ReindentObjOps' => ['ReindentAndAlignObjOps'],
        'RestoreComments' => ['OrganizeClass', 'ReindentComments'],

        'PSR1OpenTags' => ['ReindentComments'],
        'PSR1BOMMark' => ['ReindentComments'],
        'PSR1ClassConstants' => ['ReindentComments'],
        'PSR1ClassNames' => ['ReindentComments'],
        'PSR1MethodNames' => ['ReindentComments'],
        'PSR2KeywordsLowerCase' => ['ReindentComments'],
        'PSR2IndentWithSpace' => ['ReindentComments'],
        'PSR2LnAfterNamespace' => ['ReindentComments'],
        'PSR2CurlyOpenNextLine' => ['ReindentComments'],
        'PSR2ModifierVisibilityStaticOrder' => ['ReindentComments'],
        'PSR2SingleEmptyLineAndStripClosingTag' => ['ReindentComments'],
    ];

    private $shortcircuits = [];

    public function __construct()
    {
        // what do we do with this shit?
        if (! defined('ST_AT')) {
            define('ST_AT', '@');
        }
        if (! defined('ST_BRACKET_CLOSE')) {
            define('ST_BRACKET_CLOSE', ']');
        }
        if (! defined('ST_BRACKET_OPEN')) {
            define('ST_BRACKET_OPEN', '[');
        }
        if (! defined('ST_COLON')) {
            define('ST_COLON', ':');
        }
        if (! defined('ST_COMMA')) {
            define('ST_COMMA', ',');
        }
        if (! defined('ST_CONCAT')) {
            define('ST_CONCAT', '.');
        }
        if (! defined('ST_CURLY_CLOSE')) {
            define('ST_CURLY_CLOSE', '}');
        }
        if (! defined('ST_CURLY_OPEN')) {
            define('ST_CURLY_OPEN', '{');
        }
        if (! defined('ST_DIVIDE')) {
            define('ST_DIVIDE', '/');
        }
        if (! defined('ST_DOLLAR')) {
            define('ST_DOLLAR', '$');
        }
        if (! defined('ST_EQUAL')) {
            define('ST_EQUAL', '=');
        }
        if (! defined('ST_EXCLAMATION')) {
            define('ST_EXCLAMATION', '!');
        }
        if (! defined('ST_IS_GREATER')) {
            define('ST_IS_GREATER', '>');
        }
        if (! defined('ST_IS_SMALLER')) {
            define('ST_IS_SMALLER', '<');
        }
        if (! defined('ST_MINUS')) {
            define('ST_MINUS', '-');
        }
        if (! defined('ST_MODULUS')) {
            define('ST_MODULUS', '%');
        }
        if (! defined('ST_PARENTHESES_CLOSE')) {
            define('ST_PARENTHESES_CLOSE', ')');
        }
        if (! defined('ST_PARENTHESES_OPEN')) {
            define('ST_PARENTHESES_OPEN', '(');
        }
        if (! defined('ST_PLUS')) {
            define('ST_PLUS', '+');
        }
        if (! defined('ST_QUESTION')) {
            define('ST_QUESTION', '?');
        }
        if (! defined('ST_QUOTE')) {
            define('ST_QUOTE', '"');
        }
        if (! defined('ST_REFERENCE')) {
            define('ST_REFERENCE', '&');
        }
        if (! defined('ST_SEMI_COLON')) {
            define('ST_SEMI_COLON', ';');
        }
        if (! defined('ST_TIMES')) {
            define('ST_TIMES', '*');
        }
        if (! defined('ST_BITWISE_OR')) {
            define('ST_BITWISE_OR', '|');
        }
        if (! defined('ST_BITWISE_XOR')) {
            define('ST_BITWISE_XOR', '^');
        }
        if (!defined('T_POW')) {
            define('T_POW', '**');
        }
        if (!defined('T_POW_EQUAL')) {
            define('T_POW_EQUAL', '**=');
        }
        if (!defined('T_YIELD')) {
            define('T_YIELD', 'yield');
        }
        if (!defined('T_FINALLY')) {
            define('T_FINALLY', 'finally');
        }
        if (!defined('T_SPACESHIP')) {
            define('T_SPACESHIP', '<=>');
        }
        if (!defined('T_COALESCE')) {
            define('T_COALESCE', '??');
        }

        define('ST_PARENTHESES_BLOCK', 'ST_PARENTHESES_BLOCK');
        define('ST_BRACKET_BLOCK', 'ST_BRACKET_BLOCK');
        define('ST_CURLY_BLOCK', 'ST_CURLY_BLOCK');


        $this->passes['AddMissingCurlyBraces'] = new AddMissingCurlyBraces();
        $this->passes['EliminateDuplicatedEmptyLines'] = new EliminateDuplicatedEmptyLines();
        $this->passes['ExtraCommaInArray'] = new ExtraCommaInArray();
        $this->passes['LeftAlignComment'] = new LeftAlignComment();
        $this->passes['MergeCurlyCloseAndDoWhile'] = new MergeCurlyCloseAndDoWhile();
        $this->passes['MergeDoubleArrowAndArray'] = new MergeDoubleArrowAndArray();
        $this->passes['MergeParenCloseWithCurlyOpen'] = new MergeParenCloseWithCurlyOpen();
        $this->passes['NormalizeIsNotEquals'] = new NormalizeIsNotEquals();
        $this->passes['NormalizeLnAndLtrimLines'] = new NormalizeLnAndLtrimLines();
        $this->passes['OrderAndRemoveUseClauses'] = new OrderAndRemoveUseClauses();
        $this->passes['Reindent'] = new Reindent();
        $this->passes['ReindentColonBlocks'] = new ReindentColonBlocks();
        $this->passes['ReindentComments'] = new ReindentComments();
        $this->passes['ReindentEqual'] = new ReindentEqual();
        $this->passes['ReindentObjOps'] = new ReindentObjOps();
        $this->passes['RemoveIncludeParentheses'] = new RemoveIncludeParentheses();
        $this->passes['ResizeSpaces'] = new ResizeSpaces();
        $this->passes['RTrim'] = new RTrim();
        $this->passes['SplitCurlyCloseAndTokens'] = new SplitCurlyCloseAndTokens();
        $this->passes['StripExtraCommaInList'] = new StripExtraCommaInList();
        $this->passes['TwoCommandsInSameLine'] = new TwoCommandsInSameLine();

        $this->hasAfterExecutedPass = method_exists($this, 'afterExecutedPass');
        $this->hasAfterFormat = method_exists($this, 'afterFormat');
        $this->hasBeforePass = method_exists($this, 'beforePass');
        $this->hasBeforeFormat = method_exists($this, 'beforeFormat');
    }

    public function disablePass($pass)
    {
        $this->passes[$pass] = null;
    }

    /**
     * Overrides the default configuration with the configuration
     * passed to the command from the command line. This should
     * override even if whe have selected psr2 with 4 spaces
     *
     * @param      array  $options  The options
     */
    public function configure($options)
    {
        foreach ($options as $option => $value) {
            $this->options[$option] = $value;
        }
    }

    public function enablePass($pass)
    {
        $args = func_get_args();
        if (!isset($args[1])) {
            $args[1] = null;
        }

        if (!class_exists($pass)) {
            sprintf("Class doesn't exist: $pass");
            $passName = sprintf('ExternalPass%s', $pass);
            $passes = array_reverse($this->passes, true);
            $passes[$passName] = new ExternalPass($pass);
            $this->passes = array_reverse($passes, true);

            return;
        }

        if (isset($this->shortcircuits[$pass])) {
            return;
        }

        $this->passes[$pass] = new $pass($args[1]);

        $scPasses = &$this->shortcircuit[$pass];
        if (isset($scPasses)) {
            foreach ($scPasses as $scPass) {
                $this->disablePass($scPass);
                $this->shortcircuits[$scPass] = $pass;
            }
        }
    }

    public function forcePass($pass)
    {
        $this->shortcircuits = [];
        $args = func_get_args();

        return call_user_func_array([$this, 'enablePass'], $args);
    }

    public function formatCode($source = '')
    {
        $passes = array_map(
            function ($pass) {
                return clone $pass;
            },
            array_filter($this->passes)
        );
        list($foundTokens, $commentStack) = $this->getFoundTokens($source);
        $this->hasBeforeFormat && $this->beforeFormat($source);
        while (($pass = array_pop($passes))) {
            $this->hasBeforePass && $this->beforePass($source, $pass);
            if ($pass->candidate($source, $foundTokens)) {
                if (isset($pass->commentStack)) {
                    $pass->commentStack = $commentStack;
                }
                $source = $pass->format($source);
                $this->hasAfterExecutedPass && $this->afterExecutedPass($source, $pass);
            }
        }
        $this->hasAfterFormat && $this->afterFormat($source);

        return $source;
    }

    public function getPassesNames()
    {
        return array_keys(array_filter($this->passes));
    }

    protected function getToken($token)
    {
        $ret = [$token, $token];
        if (isset($token[1])) {
            $ret = $token;
        }

        return $ret;
    }

    private function getFoundTokens($source)
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
