<?php
/**
 * Package prefix for autoloader.
 */
$loader->add('Aura\Cli\\', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src');

/**
 * Instance params and setter values.
 */

// Translator
$di->params['Aura\Cli\Translator']['locale'] = 'en_US';
$di->params['Aura\Cli\Translator']['catalog'] = require dirname(__DIR__)
                                              . DIRECTORY_SEPARATOR . 'intl'
                                              . DIRECTORY_SEPARATOR . 'catalog.php';

// ExceptionFactory
$di->params['Aura\Cli\ExceptionFactory']['translator'] = $di->lazyNew('Aura\Cli\Translator');

// Getopt
$di->params['Aura\Cli\Getopt']['option_factory'] = $di->lazyNew('Aura\Cli\OptionFactory');
$di->params['Aura\Cli\Getopt']['exception_factory'] = $di->lazyNew('Aura\Cli\ExceptionFactory');

// Stdio
$di->params['Aura\Cli\Stdio']['stdin'] = $di->lazyNew('Aura\Cli\StdioResource', [
    'filename' => 'php://stdin',
    'mode' => 'r',
]);

$di->params['Aura\Cli\Stdio']['stdout'] = $di->lazyNew('Aura\Cli\StdioResource', [
    'filename' => 'php://stdout',
    'mode' => 'w+',
]);

$di->params['Aura\Cli\Stdio']['stderr'] = $di->lazyNew('Aura\Cli\StdioResource', [
    'filename' => 'php://stderr',
    'mode' => 'w+',
]);

$di->params['Aura\Cli\Stdio']['vt100'] = $di->lazyNew('Aura\Cli\Vt100');

// Command
$di->params['Aura\Cli\AbstractCommand']['context'] = $di->lazyGet('cli_context');
$di->params['Aura\Cli\AbstractCommand']['stdio']   = $di->lazyGet('cli_stdio');
$di->params['Aura\Cli\AbstractCommand']['getopt']  = $di->lazyNew('Aura\Cli\Getopt');
$di->params['Aura\Cli\AbstractCommand']['signal']  = $di->lazyGet('signal_manager');

/**
 * Dependency services.
 */
$di->set('cli_context', $di->lazyNew('Aura\Cli\Context', [
    'globals' => $GLOBALS,
]));

$di->set('cli_stdio', $di->lazyNew('Aura\Cli\Stdio'));
