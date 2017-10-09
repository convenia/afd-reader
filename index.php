<?php

require 'vendor/autoload.php';
use Convenia\AfdReader\AfdReader;

$afdReader = new AfdReader('tests/acjef_2_test.txt');


echo '<pre>';
print_r($afdReader->getAll());
echo '</pre>';