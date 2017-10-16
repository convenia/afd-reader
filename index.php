<?php

require 'vendor/autoload.php';

use Convenia\AfdReader\AfdReader;

$afdReader = new AfdReader('tests/acjef_1_test.txt');

echo '<pre>';
print_r($afdReader->getByUser());
echo '</pre>';