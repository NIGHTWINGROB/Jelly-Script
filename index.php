<?php

require 'vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

const BASE_URL = 'https://api.tomtom.com/search/2/search.json';

$apiKey=$_ENV['API_KEY'];

$queryString = http_build_query([
   'radius' => 150,
   'minFuzzyLevel' => 1,
   'maxFuzzyLevel'=> 0,
   'view' => 'Unified',
   'relatedPois' => 'all',
   'api_key' => $apiKey,

]);

$requestUri = sprintf(
   '%s/rest/?%s',
   BASE_URL,
   $queryString
);

$ch = curl_init();

$url = "https://api.tomtom.com/search/2/search.json?radius=150&minFuzzyLevel=1&maxFuzzyLevel=2&view=Unified&relatedPois=all&key={7RrTPGdvxUKIQEyNkJTB3A3Kv0pquUn5}";

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $requestUri);
curl_setopt($ch, CURLOPT_SSH_COMPRESSION, true);
curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_URL => $requestUri
]);

$result = curl_exec($ch);

if($e = curl_error($ch)) {
    echo $e;
}
else {
    $decoded = json_decode($resp);
    print_r($decoded);
}

curl_close($ch);



?>

