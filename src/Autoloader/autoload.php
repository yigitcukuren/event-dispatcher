<?php

namespace YigitCukuren\Events\Autoloader;

require_once __DIR__ . '/Psr4Autoloader.php';

/**
 * @var string
 * Full path to "src" which is what we want "YigitCukuren\Events" to map to.
 */
$srcBaseDirectory = \dirname(\dirname(__FILE__));

$loader = new Psr4Autoloader();
$loader->register();
$loader->addNamespace('YigitCukuren\Events', $srcBaseDirectory);
