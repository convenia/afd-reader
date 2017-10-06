<?php

require 'vendor/autoload.php';

use Convenia\AfdReader\AfdReader;

$objAfdReader = new AfdReader('tests/afd_test.txt');
$array = $objAfdReader->getAll();

echo '<pre>';
print_r($array);
echo '</pre>';