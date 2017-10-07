<?php

require 'vendor/autoload.php';

use Convenia\AfdReader\AfdReader;

$objAfdReader = new AfdReader('tests/acjef_1_test.txt');
$array = $objAfdReader->getByUser();
