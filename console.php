<?php
/**
 * @author Matteo Giachino <matteog@gmail.com>
 */

require 'vendor/autoload.php';

use Symfony\Component\Console\Application;

$app = new Application('es-test');
$app->add(new \EsTest\Command\InsertCommand());
$app->add(new \EsTest\Command\ResetCommand());
$app->run();