<?php

$token = $this->getToken();

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'http://mypropedge.com/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$headers = array();
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_exec($ch);

echo('done');







?>