<?php

include __DIR__ . '/../vendor/autoload.php';

$code = 'pl';

if ($_GET && !empty($_GET['code'])) {
    $code = $_GET['code'];
} elseif(!empty($argv[1])) {
    $code = $argv[1];
}


$countryProvider = new \LabStudio\GeoPolitic\CountryProvider();

try {
    var_dump($countryProvider->get($code));
} catch (\LabStudio\GeoPolitic\Exception\CountryProviderException $e) {
    echo $e->getMessage().PHP_EOL;
    echo $e->getTraceAsString().PHP_EOL;
}
