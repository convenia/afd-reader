<?php

require 'vendor/autoload.php';

use Convenia\AfdReader\AfdReader;

$afdReader = new AfdReader('tests/afdt_test_small.txt');

echo '<pre>';
print_r($afdReader->getAll());
echo '</pre>';
