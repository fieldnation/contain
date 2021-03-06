<?php
/**
 * Contain Project
 *
 * Recursively scans each module in the main project directory for entity
 * definitions and compiles them one-by-one.
 *
 * This source file is subject to the BSD license bundled with
 * this package in the LICENSE.txt file. It is also available
 * on the world-wide-web at http://www.opensource.org/licenses/bsd-license.php.
 * If you are unable to receive a copy of the license or have
 * questions concerning the terms, please send an email to
 * me@andrewkandels.com.
 *
 * @category    akandels
 * @package     contain
 * @author      Andrew Kandels (me@andrewkandels.com)
 * @copyright   Copyright (c) 2012 Andrew P. Kandels (http://andrewkandels.com)
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD License
 * @link        http://andrewkandels.com/contain
 */

require_once(__DIR__ . '/abstract-script.php');

if (empty($argv[1])) {
    fprintf(STDERR, "Syntax: compile-directory (e.g.: src/Contain/Entity/Definition)\n"
        . "Note: Your project must support autoloading for the specified classes.\n"
    );
    exit(1);
}

$compiler = $serviceManager->get('Contain\Entity\Compiler\Compiler');
$entityIterator = new \DirectoryIterator($argv[1]);
$exitCode = 0;
$num = 0;

foreach ($entityIterator as $entity) {
    if ($entity->isFile() && $entity->getExtension() == 'php') {
        $num++;

        $pos = strpos($entity->getPathname(), 'src/');
        if ($pos === false) {
            fprintf(STDERR, "[ Failed ]\nThere must be a 'src' directory referenced.");
            exit(1);
        }

        $className = substr($entity->getPathname(), $pos + 4, -4);
        $className = str_replace('/', '\\', $className);

        if (preg_match('/(Abstract|Interface)/', $className)) {
            continue;
        }

        fprintf(STDERR, '%-60s ... ', sprintf("Compiling '%s'", $className));

        try {
            $compiler->compile($className);
            fprintf(STDERR, "[ Ok ]\n");
        } catch (Exception $e) {
            $exitCode = 1;
            fprintf(STDERR, "[ Failed ]\nException: %s\n--\n%s\n\n... continuing ...\n\n",
                $e->getMessage(),
                $e->getTraceAsString()
            );
        }
    }
}

exit($exitCode);
