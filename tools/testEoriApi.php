<?php

$eoriNumber = 'GB123456123456';

$url = getenv('RUNTIME_URL').'rest/V1/eori/validation/'.$eoriNumber;

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']
);

$result = curl_exec($ch);

echo $result;

curl_close($ch);
